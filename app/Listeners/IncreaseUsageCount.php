<?php

namespace App\Listeners;

use App\Events\FormSubmission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
            'recieved' => $event->account->recieved + 1
        ]);
    }
}
