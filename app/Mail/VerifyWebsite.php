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
        return $this->markdown('emails.website.verify')
            ->with([
                'url' => $this->website->url
            ]);
    }
}
