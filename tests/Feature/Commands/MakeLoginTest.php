<?php

namespace Tests\Feature\Commands;

use App\Enums\ActivityType;
use App\Models\Account;
use App\Models\Activity;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MakeLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_login_with_valid_data()
    {
        $account = Account::first();
        $this->artisan('login:make', [
            'user' => $account->email
        ])->expectsOutputToContain('Magic link for user ' . $account->email . ' is ')
            ->assertSuccessful();

        $this->assertDatabaseHas(Activity::class, [
            'account_id' => $account->id,
            'type' => ActivityType::LoginRequested
        ]);
    }

    public function test_make_login_with_invalid_data()
    {
        $this->artisan('login:make', [
            'user' => 'lmao'
        ])->expectsOutputToContain('User does not exist')
            ->assertFailed();
    }
}
