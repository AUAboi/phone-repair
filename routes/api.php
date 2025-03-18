<?php

use App\Http\Controllers\Api\DeviceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stripe\PaymentIntent;
use Stripe\Stripe;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/devices', [DeviceController::class, 'index'])->name('api.devices');

Route::post('payment-intent', function (Request $request) {
    Stripe::setApiKey(env('STRIPE_SECRET'));

    try {
        $paymentIntent = PaymentIntent::create([
            'amount' => $request->amount, // Amount in cents (e.g., 3500 for €35)
            'currency' => 'usd', // Klarna supports EUR, USD, GBP, etc.
            'payment_method_types' => ['card', 'link', 'klarna', 'alipay'], // Include Klarna
        ]);

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 400);
    }


    return response()->json(['clientSecret' => $intent->client_secret]);
});
