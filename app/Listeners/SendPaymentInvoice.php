<?php

namespace App\Listeners;

use App\Events\PaymentProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendPaymentInvoice implements ShouldQueue
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
     * @param  PaymentProcessed  $event
     * @return void
     */
    public function handle(PaymentProcessed $event)
    {
        return \Mail::to($event->order->account->email)
            ->send(new \App\Mail\SendPaymentInvoice(
                $event->order->plan->amount,
                $event->order->plan->quantity,
                $event->order->account->allowed,
                $event->order->code
            ));
    }
}
