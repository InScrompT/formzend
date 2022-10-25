<?php

namespace App\Repositories;

use App\Enums\ActivityType;
use App\Models\Activity;
use App\Models\Website;
use Illuminate\Support\Str;

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
