<?php

namespace App\Mail;

use App\Models\Account;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreditExhausted extends Mailable
{
    use Queueable, SerializesModels;

    private $account;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('[FormZend] Credit limit exhausted. Increase limit')
            ->with('account', $this->account)
            ->markdown('emails.payment.exhausted');
    }
}
