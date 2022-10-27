<?php

namespace Tests\Unit;

use App\Mail\CreditExhausted;
use App\Mail\FormSubmission;
use App\Mail\SendPaymentInvoice;
use App\Mail\VerifyLogin;
use App\Mail\VerifyWebsite;
use App\Models\Account;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class MailTest extends TestCase
{
    use RefreshDatabase;

    public function test_credit_exhausted_mail()
    {
        $account = Account::first();

        $mailable = new CreditExhausted($account);

        $mailable->build();
        $mailable->assertHasSubject('[FormZend] Credit limit exhausted. Increase limit');
        $mailable->assertSeeInHtml('Credits Exhausted');
    }

    public function test_form_submission_mail()
    {
        $website = Website::whereVerified(true)->first();
        $submission = $website->submissions()->latest()->first();

        (new FormSubmission($website, $submission->data->toArray()))
            ->build()
            ->assertHasSubject('New form submission at ' . $website->url)
            ->assertTo($website->account->email)
            ->assertHasReplyTo(config('mail.reply.address'), config('mail.reply.name'));
    }

    public function test_payment_invoice_mail()
    {
        (new SendPaymentInvoice(
            price: 10,
            submissions: 1000,
            total: 1500,
            code: Str::uuid()
        ))
            ->build()
            ->assertHasSubject('[FormZend] Account is upgraded')
            ->assertHasReplyTo(config('mail.reply.address'), config('mail.reply.name'));
    }

    public function test_login_request_mail()
    {
        (new VerifyLogin('lmao'))
            ->build()
            ->assertHasSubject('[FormZend] Login to your account')
            ->assertHasReplyTo(config('mail.reply.address'), config('mail.reply.name'));
    }

    public function test_verify_website_mail()
    {
        $website = Website::whereVerified(false)->first();

        (new VerifyWebsite(website: $website, signedURL: 'lmao bro'))
            ->build()
            ->assertHasSubject('[FormZend] Verify new website | ' . $website->url)
            ->assertHasReplyTo(config('mail.reply.address'), config('mail.reply.name'));
    }
}
