<?php

namespace App\Http\Controllers;

use App\Account;
use App\Website;
use App\Mail\VerifyWebsite;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('resendVerification');
    }

    public function verify(Account $account, Website $website)
    {
        try {
            $website->verified = true;
            $website->saveOrFail();

            return view('website.verified')->with([
                'url' => $website->url,
                'email' => $account->email
            ]);
        } catch (\Throwable $e) {
            return view('website.error')->with([
                'title' => 'Unknown error',
                'error' => 'Something bad happened in my end. Please contact me in twitter if this issue persists',
            ]);
        }
    }

    public function resendVerification(Account $account, Website $website)
    {
        \Mail::to($account->email)
            ->queue(new VerifyWebsite($website));

        return view('website.verify')->with([
            'url' => $website->url,
            'email' => $account->email
        ]);
    }
}
