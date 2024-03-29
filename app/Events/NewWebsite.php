<?php

namespace App\Events;

use App\Models\Website;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewWebsite
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $website;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\Website $website
     */
    public function __construct(Website $website)
    {
        $this->website = $website;
    }
}
