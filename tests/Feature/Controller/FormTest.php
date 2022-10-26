<?php

namespace Tests\Feature\Controller;

use App\Mail\CreditExhausted;
use App\Mail\FormSubmission;
use App\Mail\VerifyWebsite;
use App\Models\Account;
use App\Models\Submission;
use App\Models\Website;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_cannot_submit_form_with_invalid_email()
    {
        $this->post(route('form', 'lmao bro'))
            ->assertViewIs('website.error')
            ->assertViewHasAll([
                'title' => 'Invalid Email',
                'error' => 'Please enter a valid email. The format is ' . route('form', 'your@email.com')
            ])
            ->assertStatus(400);
    }

    public function test_submit_form_without_verified_host()
    {
        Mail::fake();

        $domain = $this->faker->domainName();
        $account = Account::first();
        $data = [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber()
        ];

        $this->post(route('form', $account->email), $data, [
            'referer' => $domain
        ])->assertRedirect(route('website.verify.show', [$domain, $account->email]));

        $this->assertDatabaseHas(Account::class, [
            'email' => $account->email
        ])->assertDatabaseHas(Website::class, [
            'url' => $domain,
            'account_id' => $account->id,
            'verified' => false
        ]);

        Mail::assertSent(VerifyWebsite::class, function (Mailable $mail) use ($account) {
            return $mail->hasTo($account->email);
        });
    }

    public function test_submit_form_with_verified_host()
    {
        Mail::fake();

        $account = Account::first();
        $website = $account->websites()->whereVerified(true)->first();
        $domain = $website->url;
        $data = [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber()
        ];

        $this->post(route('form', $account->email), $data, [
            'referer' => $domain
        ])->assertViewIs('form.submitted')
            ->assertViewHas('url', $domain);

        $this->assertDatabaseHas(Account::class, [
            'email' => $account->email
        ])->assertDatabaseHas(Website::class, [
            'url' => $domain,
            'account_id' => $account->id,
            'verified' => true
        ])->assertDatabaseHas(Submission::class, [
            'account_id' => $account->id,
            'website_id' => $website->id,
            'data' => json_encode($data)
        ]);

        $fresh = Account::find($account->id);

        $this->assertEquals($account->recieved + 1, $fresh->recieved);
        $this->assertEquals($account->allowed - 1, $fresh->allowed);

        Mail::assertSent(FormSubmission::class);
    }

    public function test_submit_form_with_verified_host_and_valid_redirect()
    {
        Mail::fake();

        $account = Account::first();
        $website = $account->websites()->whereVerified(true)->first();
        $domain = $website->url;
        $redirect = $this->faker->url();
        $data = [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber()
        ];

        $this->post(route('form', $account->email), ['_redirect' => $redirect, ...$data], [
            'referer' => $domain
        ]);

        $this->assertDatabaseHas(Account::class, [
            'email' => $account->email
        ])->assertDatabaseHas(Website::class, [
            'url' => $domain,
            'account_id' => $account->id,
            'verified' => true
        ])->assertDatabaseHas(Submission::class, [
            'account_id' => $account->id,
            'website_id' => $website->id,
            'data' => json_encode($data)
        ]);

        $fresh = Account::find($account->id);

        $this->assertEquals($account->recieved + 1, $fresh->recieved);
        $this->assertEquals($account->allowed - 1, $fresh->allowed);

        Mail::assertSent(FormSubmission::class);
    }

    public function test_submit_form_with_no_credits()
    {
        Mail::fake();

        $account = Account::first();
        $website = $account->websites()->whereVerified(true)->first();
        $domain = $website->url;
        $data = [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber()
        ];

        $account->update([
            'recieved' => 100,
            'allowed' => 0
        ]);

        $this->post(route('form', $account->email), $data, [
            'referer' => $domain
        ])->assertViewIs('website.error')
            ->assertViewHasAll([
                'title' => 'Credits Exhausted',
                'error' => 'The owner has exhausted the credits. If you\'re the owner, go to dashboard and top-up credits',
            ]);

        Mail::assertSent(CreditExhausted::class);
    }
}
