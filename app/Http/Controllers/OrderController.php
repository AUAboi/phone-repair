<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;

use App\Mail\OrderPlaced;
use Stripe\PaymentIntent;
use App\Mail\OrderShipped;
use App\Mail\OrderCancelled;
use App\Mail\OrderDelivered;
use Illuminate\Http\Request;
use App\Actions\ChargePayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')
            ->with(['user'])
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Orders/Index', [
            'orders' => OrderResource::collection($orders),
        ]);
    }

    public function store(StoreOrderRequest $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));


        if (auth()->id()) {
            \Cart::session(auth()->id());
        } else {
            \Cart::session(request()->session()->getId());
        }

        $row = \Cart::getContent();

        $cartContent = [];

        if ($row->count()) {
            foreach ($row as $key => $item) {
                $product = Product::find($item->id);
                if (!$product) {
                    \Cart::remove($item->id);
                    return redirect()->route('cart.index')->with('error', 'One or more products in your cart are no longer available.');
                }
            }

            $cartContent = $row->transform(fn($item) => [
                'id' => $item->id,
                'product_id' => $item->associatedModel->id,
                'name' => $item->associatedModel->name,
                'price' => $item->associatedModel->formatted_price,
                'price_original' => $item->associatedModel->price,
                'quantity' => $item->quantity,
                'total_price' => config('constants.currency') . ' ' . $item->associatedModel->price * $item->quantity,
            ]);
        }

        if (!count($cartContent)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            $order = DB::transaction(function () use ($request, $cartContent) {
                $order = Order::create([
                    'user_id' => auth()->id() ?? null,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'address' => $request->address,
                    'total' => \Cart::getTotal(),
                ]);

                $order->order_no = $this->generateNumber($order);

                $order->save();

                foreach ($cartContent as $key => $item) {
                    $order->products()->create(
                        [
                            'quantity' => $item['quantity'],
                            'price' => $item['price_original'],
                            'name' => $item['name'],
                            'product_id' => $item['product_id']
                        ]
                    );
                }

                \Cart::clear();

                Mail::to($order->email)->send(new OrderPlaced($order));

                return $order;
            });
        } catch (Exception $e) {
            return redirect()->route('public.home')->with('error', $e->getMessage());
        }

        try {
            $paymentIntent = PaymentIntent::retrieve($request->paymentIntentId);


            // Update the payment intent with metadata
            PaymentIntent::update($request->paymentIntentId, [
                'metadata' => ['order_id' => $order->order_no, 'type' => 'order'],
            ]);


            //Make sure payment intent total matches order total
            if ($paymentIntent->amount !== (int)$order->total * 100) {
                return redirect()->route('order.show',  $order->order_no)->with('error', 'Payment failed. Please try again.');
            }

            // Make sure return url has payment intent id
            $paymentIntent->confirm([
                'payment_method' => $request->paymentMethodId,
                'return_url' => route('order.show',  $order->order_no),
            ]);

            if ($paymentIntent->status === 'requires_action' && isset($paymentIntent->next_action->redirect_to_url)) {
                return Inertia::location($paymentIntent->next_action->redirect_to_url->url); // Redirect to PayPal
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->route('order.show',  $order->order_no)->with('error', 'Stripe error: ' . $e->getMessage());
        } catch (\Throwable $th) {
            return redirect()->route('order.show',  $order->order_no)->with('error', 'Payment failed. Please try again.');
        }

        return redirect()->route('order.show',  $order->order_no);
    }

    public function show(Order $order)
    {
        return Inertia::render("Public/Orders/Show", [
            'previous_orders' => $order->user ? count($order->user->orders) : null,
            'order' => new OrderResource($order->load(['products', 'products.product', 'products.product.media']))
        ]);
    }

    public function edit(Order $order)
    {
        return Inertia::render("Admin/Orders/Edit", [
            'order' => new OrderResource($order->load(['products', 'products.product', 'products.product.media']))
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:delivered,preparing,cancelled,in-transit',
            'send_email' => 'required|boolean'
        ]);

        $order->update([
            'order_status' => $request->order_status
        ]);

        if ($request->send_email) {
            if ($request->order_status === "in-transit") {
                Mail::to($order->email)->send(new OrderShipped($order));
            } else if ($request->order_status === "cancelled") {
                Mail::to($order->email)->send(new OrderCancelled($order));
            } else if ($request->order_status === "delivered") {
                Mail::to($order->email)->send(new OrderDelivered($order));
            }
        }



        return redirect()->back()->with("success", "Updated successfully");
    }

    private function generateNumber(Order $order)
    {
        $dt = new DateTime;
        return 'OD' . $dt->format('Ymd') .  $order->id;
    }

    public function paymentPage(Order $order)
    {
        if ($order->payment_status === 'paid') {
            return redirect()->back()->with('error', 'Paid already');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntentId = Session::get('order_payment_intent_id');
        $paymentIntent = null;

        if ($paymentIntentId) {
            try {
                $paymentIntent = PaymentIntent::retrieve($paymentIntentId);


                // If the PaymentIntent exists and is still modifiable, update it
                if ($paymentIntent->status === 'requires_payment_method' && $paymentIntent->amount !== (int)$order->total * 100) {
                    PaymentIntent::update($paymentIntent->id, ['amount' => $order->total * 100]);
                }
            } catch (\Exception $e) {
                // If PaymentIntent retrieval fails, create a new one
                $paymentIntent = null;
            }
        }

        // If PaymentIntent does not exist or cannot be updated, create a new one
        if (!$paymentIntent || $paymentIntent->status !== 'requires_payment_method') {
            $paymentIntent = PaymentIntent::create([
                'amount' => $order->total * 100,
                'currency' => config('constants.currency'),
                'payment_method_types' => ['card', 'paypal', 'klarna'],
            ]);

            // Store new PaymentIntent ID
            Session::put('order_payment_intent_id', $paymentIntent->id);
        }

        return Inertia::render('Public/Orders/Payment', [
            'order' => new OrderResource($order),
            'clientSecret' => $paymentIntent->client_secret,
            'stripeKey' => env('VITE_STRIPE_PUBLIC_KEY'),
            'paymentIntentId' => $paymentIntent->id
        ]);
    }

    public function paymentHandle(Request $request, Order $order)
    {
        if ($order->payment_status === 'paid') {
            return redirect()->back()->with('error', 'Paid already');
        }

        $request->validate([
            'paymentIntentId' => 'required',
            'paymentMethodId' => 'required'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::retrieve($request->paymentIntentId);


            // Update the payment intent with metadata
            PaymentIntent::update($request->paymentIntentId, [
                'metadata' => ['order_id' => $order->order_no, 'type' => 'order'],
            ]);


            //Make sure payment intent total matches order total
            if ($paymentIntent->amount !== (int)$order->total * 100) {
                return redirect()->route('order.show',  $order->order_no)->with('error', 'Payment failed. Please try again.');
            }

            // Make sure return url has payment intent id
            $paymentIntent->confirm([
                'payment_method' => $request->paymentMethodId,
                'return_url' => route('order.show',  $order->order_no),
            ]);

            if ($paymentIntent->status === 'requires_action' && isset($paymentIntent->next_action->redirect_to_url)) {
                return Inertia::location($paymentIntent->next_action->redirect_to_url->url); // Redirect to PayPal
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->route('order.show',  $order->order_no)->with('error', 'Stripe error: ' . $e->getMessage());
        } catch (\Throwable $th) {
            return redirect()->route('order.show',  $order->order_no)->with('error', 'Payment failed. Please try again.');
        }

        return redirect()->route('order.show', $order->order_no);
    }
}
