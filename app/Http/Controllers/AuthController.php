<?php

namespace App\Http\Controllers;

use App\Events\LoginRequest;
use App\Models\Account;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function processLogin()
    {
        request()->validate([
            'email' => 'required|email'
        ]);

        $account = Account::whereEmail(request('email'))->firstOrCreate([
            'email' => request('email')
        ]);
        event(new LoginRequest($account));

        return view('auth.sent')->with([
            'email' => request('email')
        ]);
    }

    public function loginUser(Account $account, $loginKey)
    {
        try {
            Activity::whereAccountId($account->id)
                ->where('login_key', $loginKey)
                ->firstOrFail()
                ->delete();

            Auth::login($account, true);

            return redirect()
                ->route('dashboard');
        } catch (\Throwable $e) {
            return view('website.error')->with([
                'title' => 'Bad Verification',
                'error' => 'The verification link has been expired. Please try again',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('home');
    }
}
