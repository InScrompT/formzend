<?php

namespace App\Events;

use App\Account;
use App\Website;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FormSubmission
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $account;
    public $website;
    public $data;

    /**
     * Create a new event instance.
     *
     * @param Account $account
     * @param Website $website
     * @param array $data
     */
    public function __construct(Account $account, Website $website, array $data)
    {
        $this->account = $account;
        $this->website = $website;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
