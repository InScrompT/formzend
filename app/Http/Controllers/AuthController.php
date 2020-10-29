<?php

namespace App\Http\Controllers;

use App\Account;
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
            'email' => 'required|email|exists:accounts'
        ]);

        event(new LoginRequest(
            Account::whereEmail(request('email'))->firstOrFail()
        ));

        return view('auth.sent');
    }

    public function loginUser(Account $account)
    {
        \Auth::login($account);

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
