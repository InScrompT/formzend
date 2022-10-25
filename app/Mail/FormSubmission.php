<?php

namespace App\Mail;

use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmission extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\Website
     */
    public $website;

    /**
     * @var array
     */
    public $data;

    /**
     * Create a new message instance.
     *
     * @param Website $website
     * @param array $data
     */
    public function __construct(Website $website, array $data)
    {
        $this->website = $website;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.form.submit')
            ->subject('New form submission at ' . $this->website->url)
            ->to($this->website->account->email)
            ->replyTo(config('mail.reply.address'), config('mail.reply.name'))
            ->with([
                'url' => $this->website->url,
                'form' => $this->data
            ]);
    }
}
