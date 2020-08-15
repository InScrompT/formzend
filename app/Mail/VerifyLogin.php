<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyLogin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $signedURL;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($signedURL)
    {
        $this->signedURL = $signedURL;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.verify', [
            'url' => $this->signedURL
        ])->subject('[FormZend] Login to your account');
    }
}
