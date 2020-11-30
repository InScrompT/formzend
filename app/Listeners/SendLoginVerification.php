<?php

namespace App\Listeners;

use App\Activity;
use App\Mail\VerifyLogin;
use App\Enums\ActivityType;
use Illuminate\Support\Str;
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
        $activity = new Activity;

        $activity->account_id = $event->account->id;
        $activity->type = ActivityType::LoginRequested;
        $activity->login_key = Str::uuid();

        $activity->saveOrFail();

        $signedURL = route('login.verify', [$event->account->id, $activity->login_key]);

        \Mail::to($event->account->email)
            ->send(new VerifyLogin($signedURL));
    }
}
