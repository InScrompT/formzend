<?php

namespace App\Http\Controllers;

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

    public function unverified()
    {
        return view('dashboard.unverified');
    }

    public function listSubmissions(Website $website)
    {
        $this->authorize('listSubmissions', $website);
        $submissions = Submission::whereWebsiteId($website->id)->latest();

        return view('dashboard.submissions.list')->with([
            'website' => $website,
            'submissions' => $submissions->paginate(50)
        ]);
    }

    public function showSubmission(Submission $submission)
    {
        $this->authorize('view', $submission);

        return view('dashboard.submissions.show')->with([
            'submission' => $submission
        ]);
    }

    public function exportSubmissions(Website $website)
    {
        $this->authorize('exportSubmissions', $website);

        $csv = Writer::createFromString();
        $fileName = now()->unix() . '-' . auth()->user()->email . '-' . $website->id . '.csv';

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
