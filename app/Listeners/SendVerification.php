<?php

namespace App\Listeners;

use App\Activity;
use App\Events\NewWebsite;
use App\Mail\VerifyWebsite;
use Illuminate\Support\Str;
use App\Enums\ActivityType;

class SendVerification
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
     * @param NewWebsite $event
     * @return void
     */
    public function handle(NewWebsite $event)
    {
        $activity = new Activity;

        $activity->account_id = $event->website->account_id;
        $activity->website_id = $event->website->id;
        $activity->login_key = Str::uuid();
        $activity->type = ActivityType::WebsiteVerification;

        $activity->saveOrFail();

        $signedURL = route('website.verify', [$event->website->id, $activity->login_key]);
        \Mail::to($event->website->account->email)
            ->send(new VerifyWebsite($event->website, $signedURL));
    }
}
