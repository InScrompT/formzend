<?php

namespace App\Listeners;

use Mail;
use App\Events\NewWebsite;
use App\Mail\VerifyWebsite;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerification implements ShouldQueue
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
     * @param NewWebsite $event
     * @return void
     */
    public function handle(NewWebsite $event)
    {
        Mail::to($event->website->account->email)
            ->send(new VerifyWebsite($event->website));
    }
}
