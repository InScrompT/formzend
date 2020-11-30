<?php

namespace App\Listeners;

use App\Mail\VerifyLogin;
use App\Events\LoginRequest;
use App\Repositories\AccountRepository;

class SendLoginVerification
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
     * @param LoginRequest $event
     * @return void
     */
    public function handle(LoginRequest $event)
    {
        $verificationCode = AccountRepository::generateVerification($event->account);
        $signedURL = route('login.verify', [$event->account->id, $verificationCode]);

        \Mail::to($event->account->email)
            ->send(new VerifyLogin($signedURL));
    }
}
