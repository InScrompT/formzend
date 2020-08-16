<?php

namespace App\Http\Controllers;

use App\Account;
use App\Website;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('dashboard.show');
    }

    public function showSubmissions(Account $account, Website $website)
    {
        return view('dashboard.submissions.list')->with([
            'website' => $website
        ]);
    }
}
