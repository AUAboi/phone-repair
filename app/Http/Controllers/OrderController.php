<?php

namespace App\Http\Controllers;

use Stripe;
use DateTime;
use Exception;
use Inertia\Inertia;
use App\Models\Order;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Admin/Orders/Index', [
            'orders' => OrderResource::collection($orders),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|phone:' . config('constants.phone_number'),
            'zip_code' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'card.token' => 'required'
        ]);


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
            DB::transaction(function () use ($request, $cartContent) {
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
                    $order->products()->create(['quantity' => $item['quantity'], 'price' => $item['price_original'], 'name' => $item['name']]);
                }

                \Cart::clear();


                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                Stripe\Charge::create([
                    "amount" => $order->total * 100,
                    "currency" => "USD",
                    "source" => $request->card['token']['id'],
                    "description" => "This payment is for test purposes",
                ]);
            });
        } catch (\Stripe\Exception\CardException $e) {
            return redirect()->route('public.home')->with('error', $e->getError()->message);
        } catch (Exception $e) {
            return redirect()->route('public.home')->with('error', $e->getMessage());
        }

        return redirect()->route('public.home')->with('success', 'Order successfull');
    }


    private function generateNumber(Order $order)
    {
        $dt = new DateTime;
        return 'OD' . $dt->format('Ymd') .  $order->id;
    }
}
