<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Inertia\Inertia;
use App\Models\Product;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

        // Retrieve cart total
        $cartTotal = \Cart::getTotal() * 100; // Convert to cents for Stripe

        // Retrieve existing PaymentIntent
        $paymentIntentId = Session::get('cart_payment_intent_id');
        $paymentIntent = null;

        if ($paymentIntentId) {
            try {
                $paymentIntent = PaymentIntent::retrieve($paymentIntentId);


                // If the PaymentIntent exists and is still modifiable, update it
                if ($paymentIntent->status === 'requires_payment_method' && $paymentIntent->amount !== (int)$cartTotal) {
                    PaymentIntent::update($paymentIntent->id, ['amount' => $cartTotal]);
                }
            } catch (\Exception $e) {
                // If PaymentIntent retrieval fails, create a new one
                $paymentIntent = null;
            }
        }

        // If PaymentIntent does not exist or cannot be updated, create a new one
        if (!$paymentIntent || $paymentIntent->status !== 'requires_payment_method') {
            $paymentIntent = PaymentIntent::create([
                'amount' => $cartTotal,
                'currency' => config('constants.currency'),
                'payment_method_types' => ['card', 'paypal', 'klarna'],
            ]);

            // Store new PaymentIntent ID
            Session::put('cart_payment_intent_id', $paymentIntent->id);
        }

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
