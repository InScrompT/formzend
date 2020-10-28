<?php

namespace App\Listeners;

use Mail;
use App\Account;
use App\Mail\VerifyLogin;
use App\Events\LoginRequest;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLoginVerification implements ShouldQueue
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
        $account = Account::whereEmail($event->email)->first();
        $signedURL = \URL::temporarySignedRoute('login.verify', now()->addDay(), [
            'account' => $account->id
        ]);

        Mail::to($event->email)
            ->send(new VerifyLogin($signedURL));
    }
}
