<?php

namespace App\Repositories;

use App\Enums\ActivityType;
use App\Models\Account;
use App\Models\Activity;
use Illuminate\Support\Str;

class AccountRepository
{
    public static function generateVerification(Account $account)
    {
        $activity = new Activity;

        $activity->account_id = $account->id;
        $activity->type = ActivityType::LoginRequested;
        $activity->login_key = Str::uuid();

        $activity->saveOrFail();

        return $activity->login_key;
    }
}
