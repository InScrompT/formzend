<?php

namespace Tests\Feature\Commands;

use App\Enums\ActivityType;
use App\Events\LoginRequest;
use App\Listeners\SendLoginVerification;
use App\Mail\VerifyLogin;
use App\Models\Account;
use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_login_with_valid_data()
    {
        Event::fake();
        $account = Account::first();

        $this->artisan('login:send', [
            'user' => $account->email
        ])->assertSuccessful()
            ->expectsOutput('Magic link has been sent to ' . $account->email);

        Event::assertDispatched(function (LoginRequest $request) use ($account) {
            return $request->account->is($account);
        });

        Event::assertListening(
            LoginRequest::class,
            SendLoginVerification::class
        );
    }

    public function test_was_mail_sent()
    {
        Mail::fake();
        $account = Account::first();

        $this->artisan('login:send', [
            'user' => $account->email
        ])->assertSuccessful()
            ->expectsOutput('Magic link has been sent to ' . $account->email);

        $this->assertDatabaseHas(Activity::class, [
            'account_id' => $account->id,
            'type' => ActivityType::LoginRequested
        ]);

        Mail::assertSent(VerifyLogin::class, function ($mail) use ($account) {
            return $mail->hasTo($account->email);
        });
    }

    public function test_send_login_with_invalid_data()
    {
        $this->artisan('login:send', [
            'user' => 'lmao'
        ])->assertFailed()
            ->expectsOutput('User does not exist');
    }
}
