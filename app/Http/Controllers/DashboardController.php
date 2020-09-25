<?php

namespace App\Http\Controllers;

use App\Account;
use App\Submission;
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

    public function listSubmissions(Account $account, Website $website)
    {
        $submissions = Submission::whereWebsiteId($website->id);

        return view('dashboard.submissions.list')->with([
            'website' => $website,
            'submissions' => $submissions->paginate(50)
        ]);
    }

    public function showSubmission(
        Account $account,
        Website $website,
        Submission $submission
    ) {
        return view('dashboard.submissions.show')->with([
            'submission' => $submission
        ]);
    }
}
