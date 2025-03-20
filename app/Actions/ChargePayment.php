<?php

namespace App\Actions;

use Stripe\PaymentIntent;
use Stripe\Stripe;

class ChargePayment
{
  /**
   * Handle the action.
   *
   * @param array $data
   * @return mixed
   */
  public function handle(array $data)
  {
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $paymentIntent = PaymentIntent::retrieve($data['paymentIntentId']);

    $paymentIntent->confirm([
      'payment_method' => $data['paymentMethodId'],
      'return_url' => route('public.order.tracking'),
    ]);

    // Check if PayPal requires further action (redirect)
    if ($paymentIntent->status === 'requires_action' && isset($paymentIntent->next_action)) {
      return response()->json([
        'requires_action' => true,
        'next_action' => $paymentIntent->next_action, // Contains PayPal redirect URL
      ]);
    }

    return response()->json([
      'requires_action' => false,
      'status' => $paymentIntent->status,
    ]);
  }
}
