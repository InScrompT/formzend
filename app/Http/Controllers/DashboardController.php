<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Submission;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use League\Csv\Writer;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $verifiedWebsites = Account::find(Auth::id())
            ->websites()
            ->where('verified', true)
            ->withCount('submissions')
            ->get();

        return view('dashboard.show')->with([
            'websites' => $verifiedWebsites
        ]);
    }

    public function unverified()
    {
        $unverifiedWebsites = Account::find(Auth::id())
            ->websites()
            ->where('verified', false)
            ->get();

        return view('dashboard.unverified')->with([
            'websites' => $unverifiedWebsites
        ]);
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
            echo $csv->toString();
        }, $fileName, [
            'Content-Type' => 'text/csv'
        ]);
    }
}
