<?php

namespace App\Listeners;

use App\Events\NewAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveNewAccount implements ShouldQueue
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
     * @param  NewAccount  $event
     * @return void
     */
    public function handle(NewAccount $event)
    {
        $event->account->saveOrFail();
    }
}
