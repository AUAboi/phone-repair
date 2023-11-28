<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use Stripe;
use DateTime;
use Exception;
use Inertia\Inertia;
use App\Models\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\OrderResource;
use App\Mail\OrderCancelled;
use App\Mail\OrderDelivered;
use App\Mail\OrderPlaced;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

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
        if (auth()->id()) {
            \Cart::session(auth()->id());
        } else {
            \Cart::session(request()->session()->getId());
        }

        $row = \Cart::getContent();

        if ($row->count()) {
            foreach ($row as $key => $item) {
                $product = Product::find($item->id);
                if (!$product) {
                    \Cart::remove($item->id);
                    unset($row[$key]);
                }
            }

            $cartContent = $row->transform(fn ($item) => [
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
            return redirect()->route('cart.index');
        }
        try {
            $order = DB::transaction(function () use ($request, $cartContent,) {
                $order = Order::create([
                    'user_id' => auth()->id() ?? null,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'zip_code' => $request->zip_code,
                    'city' => $request->city,
                    'address' => $request->address,
                    'payment_method' => $request->payment_method,
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


                if ($order->payment_method == "card") {
                    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                    Stripe\Charge::create([
                        "amount" => $order->total * 100,
                        "currency" => "USD",
                        "source" => $request->card['token']['id'],
                        "description" => "This payment is for test purposes",
                    ]);

                    $order->payment_status = "paid";
                    $order->save();
                }



                Mail::to($order->email)->send(new OrderPlaced($order));

                return $order;
            });
        } catch (\Stripe\Exception\CardException $e) {
            return redirect()->route('public.home')->with('error', $e->getError()->message);
        } catch (Exception $e) {
            return redirect()->route('public.home')->with('error', $e->getMessage());
        }

        return redirect()->route('order.show',  $order->order_no)->with('success', 'Order successfull');
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
}
