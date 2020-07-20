<?php

namespace App\Http\Controllers;

use App\Account;
use App\Jobs\ProcessVerifyWebsite;
use App\Mail\VerifyWebsite;
use App\Website;

class WebsiteController extends Controller
{
    public function verify(Account $account, Website $website)
    {
        ProcessVerifyWebsite::dispatch($website);

        return view('website.verified')->with([
            'url' => $website->url,
            'email' => $account->email
        ]);
    }

    public function resendVerification(Account $account, Website $website)
    {
        \Mail::to($account->email)
            ->send(new VerifyWebsite($website));

        return view('website.verify')->with([
            'url' => $website->url,
            'email' => $account->email
        ]);
    }
}
