<?php

namespace App\Http\Controllers;

use App\Enums\ActivityType;
use App\Mail\VerifyWebsite;
use App\Models\Account;
use App\Models\Activity;
use App\Models\Website;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\Facades\Mail;

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
        $verificationCode = WebsiteRepository::generateVerification($website);
        $signedURL = route('website.verify', [$website->id, $verificationCode]);

        Mail::to($website->account->email)
            ->send(new VerifyWebsite($website, $signedURL));

        return view('website.verify')->with([
            'url' => $website->url,
            'email' => $website->account->email,
        ]);
    }

    public function remindVerification(Account $account, Website $website) {
        return response()->view('website.remind', [
            'account' => $account->id,
            'website' => $website->id
        ])->setStatusCode(401);
    }

    public function showVerificationNotice($link, $email) {
        return response()->view('website.verify', [
            'email' => $email,
            'url' => $link
        ])->setStatusCode(401);
    }
}
