<?php

use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\StripeController;
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

Route::post('/payment-intent', [StripeController::class, 'intent'])->name('api.payment-intent');
Route::get('/publishable-key', [StripeController::class, 'publishableKey'])->name('api.publishable-key');
