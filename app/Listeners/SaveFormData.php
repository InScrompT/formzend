<?php

namespace App\Listeners;

use App\Events\FormSubmission;
use App\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveFormData implements ShouldQueue
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
     * @throws \Throwable
     */
    public function handle(FormSubmission $event)
    {
        $submission = new Submission;

        $submission->data = $event->data;
        $submission->website_id = $event->website->id;
        $submission->account_id = $event->account->id;

        $submission->saveOrFail();
    }
}
