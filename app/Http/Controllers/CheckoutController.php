<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Product;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
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
            // remove from cart if item doesnt exist anymore
            foreach ($row as $key => $item) {
                $product = Product::find($item->id);
                if (!$product) {
                    \Cart::remove($item->id);
                    unset($row[$key]);
                }
            }

            $cartContent = $row->transform(fn($item) => [
                'id' => $item->id,
                'name' => $item->associatedModel->name,
                'price' => $item->associatedModel->formatted_price,
                'associatedModel' => $item->associatedModel,
                'quantity' => $item->quantity,
                'total_price' => money($item->associatedModel->price * $item->quantity, config('constants.currency'), true)->format(),
            ]);
        }


        if (!count($cartContent)) {
            return redirect()->route('cart.index');
        }


        $paymentIntent = PaymentIntent::create([
            'amount' => \Cart::getTotal() * 100,
            'currency' => 'eur',
            'payment_method_types' => ['card', 'link', 'paypal', 'klarna'],
        ]);

        return Inertia::render('Public/Checkout/Index', [
            'clientSecret' => $paymentIntent->client_secret,
            'stripeKey' => env('VITE_STRIPE_PUBLIC_KEY'),
            'cartContents' => [
                'content' => $cartContent,
                'total' => money(\Cart::getTotal(), config('constants.currency'), true)->formatWithoutZeroes(),
                'quantity' => \Cart::getTotalQuantity()
            ]
        ]);
    }
}
