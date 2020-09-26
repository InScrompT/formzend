<?php

namespace App\Http\Controllers;

use App\Account;
use App\Website;
use App\Submission;
use League\Csv\Writer;

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

    public function exportSubmissions(Account $account, Website $website)
    {
        $csv = Writer::createFromString();
        $fileName = now()->unix() . '-' . $account->email . '-' . $website->id . '.csv';

        $website->submissions->each(function ($submission) use ($csv) {
            $csv->insertOne($submission->data->toArray());
        });

        return response()->streamDownload(function () use ($csv) {
            echo $csv->getContent();
        }, $fileName, [
            'Content-Type' => 'text/csv'
        ]);
    }
}