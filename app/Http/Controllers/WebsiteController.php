<?php

namespace App\Http\Controllers;

use App\Website;
use App\Mail\VerifyWebsite;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('resendVerification');
    }

    public function verify(Website $website)
    {
        try {
            $website->verified = true;
            $website->saveOrFail();

            return view('website.verified')->with([
                'url' => $website->url,
                'email' => $website->account->email,
            ]);
        } catch (\Throwable $e) {
            return view('website.error')->with([
                'title' => 'Unknown error',
                'error' => 'Something bad happened in my end. Please contact me in twitter if this issue persists',
            ]);
        }
    }

    public function resendVerification(Website $website)
    {
        \Mail::to($website->account->email)
            ->queue(new VerifyWebsite($website));

        return view('website.verify')->with([
            'url' => $website->url,
            'email' => $website->account->email,
        ]);
    }
}
