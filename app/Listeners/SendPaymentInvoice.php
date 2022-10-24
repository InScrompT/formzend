<?php

namespace App\Listeners;

use App\Events\PaymentProcessed;
use Illuminate\Support\Facades\Mail;

class SendPaymentInvoice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PaymentProcessed $event
     * @return void
     */
    public function handle(PaymentProcessed $event)
    {
        Mail::to($event->order->account->email)
            ->send(new \App\Mail\SendPaymentInvoice(
                $event->order->plan->amount,
                $event->order->plan->quantity,
                $event->order->account->allowed,
                $event->order->code
            ));
    }
}
