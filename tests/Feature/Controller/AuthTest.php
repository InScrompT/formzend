<?php

namespace Tests\Feature\Controller;

use App\Enums\ActivityType;
use App\Events\LoginRequest;
use App\Listeners\SendLoginVerification;
use App\Mail\VerifyLogin;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_can_view_login_page()
    {
        $this->get(route('login'))
            ->assertViewIs('auth.login')
            ->assertStatus(200);
    }

    public function test_can_login_event_check()
    {
        Event::fake();
        $email = $this->faker->unique()->email();

        $this->post(route('login'), ['email' => $email])
            ->assertViewIs('auth.sent')
            ->assertViewHasAll(['email' => $email])
            ->assertStatus(200);

        $this->assertDatabaseHas(Account::class, [
            'email' => $email
        ]);

        Event::assertDispatched(function (LoginRequest $request) use ($email) {
            return $request->account->email === $email;
        });

        Event::assertListening(
            LoginRequest::class,
            SendLoginVerification::class
        );
    }

    public function test_can_login_mail_check()
    {
        Mail::fake();
        $email = $this->faker->unique()->email();

        $this->post(route('login'), ['email' => $email])
            ->assertViewIs('auth.sent')
            ->assertViewHasAll(['email' => $email])
            ->assertStatus(200);

        $this->assertDatabaseHas(Account::class, [
            'email' => $email
        ]);

        Mail::assertSent(VerifyLogin::class, function ($mail) use ($email) {
            return $mail->hasTo($email);
        });
    }

    public function test_cannot_login_with_invalid_email()
    {
        $this->post(route('login'), ['email' => 'lmao bro'])
            ->assertSessionHasErrors(['email'])
            ->assertRedirect('/');
    }

    public function test_can_login_user_with_valid_key()
    {
        $key = Str::uuid();
        $account = Account::first();

        $account->activities()->create([
            'type' => ActivityType::LoginRequested,
            'login_key' => $key,
        ]);

        $this->get(route('login.verify', [$account, $key]))
            ->assertRedirect(route('dashboard'));

        $this->assertAuthenticated();
        $this->assertAuthenticatedAs($account);
    }

    public function test_cannot_login_user_with_invalid_key()
    {
        $account = Account::first();

        $this->get(route('login.verify', [$account, 'lol']))
            ->assertViewIs('website.error')
            ->assertViewHasAll([
                'title' => 'Bad Verification',
                'error' => 'The verification link has been expired. Please try again',
            ]);

        $this->assertGuest();
    }

    public function test_user_can_logout()
    {
        $account = Account::first();

        $this->actingAs($account)->get(route('logout'))
            ->assertRedirect(route('home'));

        $this->assertGuest();
    }

    public function test_guest_cannot_logout()
    {
        $this->get(route('logout'))
            ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_user_can_login()
    {
        $this->actingAs(Account::first())
            ->get(route('login'))
            ->assertRedirect(route('dashboard'));
    }
}
