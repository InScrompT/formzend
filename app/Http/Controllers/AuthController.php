<?php

namespace App\Http\Controllers;

use App\Account;
use App\Activity;
use App\Events\LoginRequest;

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
        Activity::whereAccountId($account->id)
            ->where('login_key', $loginKey)
            ->firstOrFail()
            ->delete();

        \Auth::login($account, true);

        return redirect()
            ->route('dashboard');
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()
            ->route('home');
    }
}
