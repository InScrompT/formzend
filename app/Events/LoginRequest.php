<?php

namespace App\Events;

use App\Models\Account;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LoginRequest
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $account;

    /**
     * LoginRequest constructor.
     *
     * @param \App\Models\Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }
}
