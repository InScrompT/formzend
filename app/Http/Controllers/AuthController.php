<?php

namespace App\Http\Controllers;

use App\Account;

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

        return [
            'email' => 'has been sent to your account'
        ];
    }

    public function loginUser(Account $account)
    {
        //
    }
}
