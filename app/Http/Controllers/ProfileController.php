<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
    public function __consturct()
    {
        $this->middleware('auth');
    }

    public function showProfile()
    {
        return view('profile');
    }
}
