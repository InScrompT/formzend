<?php

namespace App\Http\Controllers;

use App\Website;
use App\Activity;
use App\Mail\VerifyWebsite;
use App\Enums\ActivityType;

class WebsiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('resendVerification');
    }

    public function verify(Website $website, $verificationKey)
    {
        try {
            Activity::whereWebsiteId($website->id)
                ->where('login_key', $verificationKey)
                ->where('type', ActivityType::WebsiteVerification)
                ->firstOrFail()
                ->delete();

            $website->verified = true;
            $website->saveOrFail();

            return view('website.verified')->with([
                'url' => $website->url,
                'email' => $website->account->email,
            ]);
        } catch (\Throwable $e) {
            return view('website.error')->with([
                'title' => 'Bad Verification',
                'error' => 'The verification link has been expired. Please login to your account and request a new verification link',
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
