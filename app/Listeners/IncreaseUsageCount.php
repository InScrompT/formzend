<?php

namespace App\Listeners;

use App\Events\FormSubmission;

class IncreaseUsageCount
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
     * @param  FormSubmission  $event
     * @return void
     */
    public function handle(FormSubmission $event)
    {
        $event->account->update([
            'recieved' => $event->account->recieved + 1,
            'allowed' => $event->account->allowed - 1
        ]);
    }
}
