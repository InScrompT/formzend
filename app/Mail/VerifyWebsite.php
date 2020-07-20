<?php

namespace App\Mail;

use App\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyWebsite extends Mailable implements ShouldQueue
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
        $signedURL = \URL::temporarySignedRoute('website.verify', now()->addDay(), [
            'account' => $this->website->account->id,
            'website' => $this->website->url
        ]);

        return $this->markdown('emails.website.verify')
            ->subject('[FormZend] Verify new website | ' . $this->website->url)
            ->with([
                'url' => $this->website->url,
                'verify' => $signedURL
            ]);
    }
}
