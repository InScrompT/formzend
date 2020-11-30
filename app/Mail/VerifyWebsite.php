<?php

namespace App\Mail;

use App\Website;
use App\Activity;
use Illuminate\Support\Str;
use App\Enums\ActivityType;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyWebsite extends Mailable
{
    use Queueable, SerializesModels;

    public $website;

    /**
     * Create a new message instance.
     *
     * @param Website $website
     */
    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $activity = new Activity;

        $activity->account_id = $this->website->account_id;
        $activity->website_id = $this->website->id;
        $activity->login_key = Str::uuid();
        $activity->type = ActivityType::WebsiteVerification;

        $activity->saveOrFail();

        $signedURL = route('website.verify', [$this->website->id, $activity->login_key]);

        return $this->markdown('emails.website.verify')
            ->subject('[FormZend] Verify new website | ' . $this->website->url)
            ->replyTo(config('mail.reply.address'), config('mail.reply.name'))
            ->with([
                'url' => $this->website->url,
                'verify' => $signedURL
            ]);
    }
}
