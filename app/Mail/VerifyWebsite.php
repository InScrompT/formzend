<?php

namespace App\Mail;

use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyWebsite extends Mailable
{
    use Queueable, SerializesModels;

    public $website;
    public $signedURL;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Website $website
     * @param string $signedURL
     */
    public function __construct(Website $website, $signedURL)
    {
        $this->website = $website;
        $this->signedURL = $signedURL;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.website.verify')
            ->subject('[FormZend] Verify new website | ' . $this->website->url)
            ->replyTo(config('mail.reply.address'), config('mail.reply.name'))
            ->with([
                'url' => $this->website->url,
                'verify' => $this->signedURL
            ]);
    }
}
