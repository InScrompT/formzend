<?php

namespace App\Listeners;

use App\Events\NewWebsite;
use App\Mail\VerifyWebsite;
use App\Repositories\WebsiteRepository;

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
        $verificationCode = WebsiteRepository::generateVerification($event->website);
        $signedURL = route('website.verify', [$event->website->id, $verificationCode]);

        \Mail::to($event->website->account->email)
            ->send(new VerifyWebsite($event->website, $signedURL));
    }
}
