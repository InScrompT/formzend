<?php

namespace App\Http\Controllers;

use App\Account;
use App\Jobs\ProcessVerifyWebsite;
use App\Website;

class WebsiteController extends Controller
{
    public function verify(Account $account, Website $website)
    {
        ProcessVerifyWebsite::dispatch($website);

        return ['message' => 'check the database'];
    }
}
