<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Order;
use App\Mail\PaymentFailed;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;

class HandlePaymentIntentFailed implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $type = $this->webhookCall->payload['data']['object']['metadata']['type'] ?? null;

        if ($type === 'order') {
            $order = Order::where('order_no', $this->webhookCall->payload['data']['object']['metadata']['order_id'])->first();

            Mail::to($order->email)->send(new PaymentFailed($order));
        }
    }
}
