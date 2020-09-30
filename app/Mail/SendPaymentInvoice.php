<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPaymentInvoice extends Mailable
{
    use Queueable, SerializesModels;

    private $code;
    private $price;
    private $total;
    private $submissions;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($price, $submissions, $total, $code)
    {
        $this->code = $code;
        $this->price = $price;
        $this->total = $total;
        $this->submissions = $submissions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[FormZend] Account is upgraded')
            ->replyTo(config('mail.reply.address'), config('mail.reply.name'))
            ->markdown('emails.payment.invoice')
            ->with([
                'code' => $this->code,
                'price' => $this->price,
                'total' => $this->total,
                'submissions' => $this->submissions
            ]);
    }
}
