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

        event(new LoginRequest(request('email')));

        return view('auth.sent');
    }

    public function loginUser(Account $account)
    {
        session([
            'loggedIn' => true,
            'id' => $account->id,
            'email' => $account->email,
        ]);

        return redirect(route('dashboard'));
    }
}
