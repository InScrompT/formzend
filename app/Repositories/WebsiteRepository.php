<?php

namespace App\Repositories;

use App\Website;
use App\Activity;
use Illuminate\Support\Str;
use App\Enums\ActivityType;

class WebsiteRepository
{
    public static function generateVerification(Website $website)
    {
        $activity = new Activity;

        $activity->account_id = $website->account_id;
        $activity->website_id = $website->id;
        $activity->login_key = Str::uuid();
        $activity->type = ActivityType::WebsiteVerification;

        $activity->saveOrFail();

        return $activity->login_key;
    }
}
