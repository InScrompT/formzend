<?php

namespace App\Listeners;

use App\Mail\VerifyLogin;
use App\Events\LoginRequest;

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
        $signedURL = \URL::temporarySignedRoute('login.verify', now()->addDay(), [
            'account' => $event->account->id,
        ]);

        \Mail::to($event->account->email)
            ->send(new VerifyLogin($signedURL));
    }
}
