<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login()
    {
        $credentials = \request()->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (\Auth::attempt($credentials)) {
            \request()->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'Incorrect username or password',
        ]);
    }

    public function register()
    {
        \request()->validate([
            'name' => ['required', 'max:100'],
            'email' => ['email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::default()]
        ]);

        $user = new User();

        $user->name = \request('name');
        $user->email = \request('email');
        $user->password = \Hash::make(\request('password'));

        $user->saveOrFail();

        return response()
            ->redirectToRoute('auth.login')
            ->with('success', 'You are registered successfully. Now please login');
    }

    public function logout()
    {
        \Auth::logout();

        return response()
            ->redirectToRoute('auth.login')
            ->with('success', 'You are logged out');
    }
}
