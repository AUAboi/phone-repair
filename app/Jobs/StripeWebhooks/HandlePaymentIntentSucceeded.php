<?php

namespace App\Jobs\StripeWebhooks;

use App\Mail\PaymentSuccessful;
use Stripe\Stripe;
use App\Models\Order;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;

class HandlePaymentIntentSucceeded implements ShouldQueue
{
    use Queueable;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;


    /**
     * Create a new job instance.
     */
    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }


    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Log::info('Received Webhook Payload:', $this->webhookCall->payload);

        $type = $this->webhookCall->payload['data']['object']['metadata']['type'] ?? null;



        if (!$type) {
            Log::error('Type is missing from webhook metadata.');
            return;
        }

        if ($type === 'order') {
            $idKey = 'order_id';
            $model = Order::class;
            $identifier = 'order_no';
        } elseif ($type === 'appointment') {
            $idKey = 'appointment_id';
            $model = Appointment::class;
            $identifier = 'appointment_number';
        } else {
            Log::error("Invalid type in webhook metadata: $type");
            return;
        }

        $id = $this->webhookCall->payload['data']['object']['metadata'][$idKey] ?? null;

        if (!$id) {
            Log::error("{$type} ID is missing from webhook metadata.");
            return;
        }

        $record = $model::where($identifier, $id)->first();

        if (!$record) {
            Log::error("{$type} not found for ID: $id");
            return;
        }

        if ($type === 'order') {
            Mail::to($record->email)->send(new PaymentSuccessful($record));
        }


        Log::info("Processing payment for {$type} ID: $id");

        try {
            $paymentMethodId = $this->webhookCall->payload['data']['object']['payment_method'] ?? null;

            if (!$paymentMethodId) {
                Log::error("Payment Method ID missing for {$type} ID: $id");
                return;
            }

            Log::info("Retrieving payment method for ID: $paymentMethodId");

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $paymentMethod = $stripe->paymentMethods->retrieve($paymentMethodId);
            $paymentMethodType = ucfirst(str_replace("_", " ", $paymentMethod->type));

            Log::info("Payment method retrieved: $paymentMethodType");

            $record->update([
                'payment_status' => 'paid',
                'payment_method' => $paymentMethodType,
            ]);

            Log::info("{$type} ID $id updated with payment status 'paid' and payment method: $paymentMethodType");
        } catch (\Exception $e) {
            Log::error("Error retrieving payment method: " . $e->getMessage());
        }
    }
}
