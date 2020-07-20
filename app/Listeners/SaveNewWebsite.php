<?php

namespace App\Listeners;

use App\Events\NewWebsite;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SaveNewWebsite implements ShouldQueue
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
     * @param  NewWebsite  $event
     * @return void
     */
    public function handle(NewWebsite $event)
    {
        //
    }
}
