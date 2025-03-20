<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function intent(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount,
                'currency' => 'gbp',
                'payment_method_types' => ['card', 'link', 'klarna', 'paypal'],
            ]);

            return response()->json(['client_secret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }


        return response()->json(['clientSecret' => $intent->client_secret]);
    }

    public function publishableKey()
    {
        return response()->json(['publishableKey' => env('VITE_STRIPE_PUBLIC_KEY')]);
    }
}
