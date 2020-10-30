<?php

namespace App\Listeners;

use App\Events\FormSubmission;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendFormData implements ShouldQueue
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
     * @param FormSubmission $event
     * @return void
     */
    public function handle(FormSubmission $event)
    {
        \Mail::send(new \App\Mail\FormSubmission(
            $event->website, $event->data
        ));
    }
}
