<?php

namespace App\Http\Controllers;

use App\Account;
use App\Submission;
use League\Csv\Writer;
use App\Events\FormSubmission;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('handleSubmission');
    }

    public function handleSubmission($email)
    {
        $url = request()->header('origin');
        $account = Account::firstWhere('email', $email);
        $website = $account->websites->firstWhere('url', $url);

        event(new FormSubmission(
            $account,
            $website,
            \request()->except('_redirect')
        ));

        $redirectTo = request('_redirect');
        $isValidRedirect = \URL::isValidUrl($redirectTo);

        if ($isValidRedirect) {
            return response()->redirectTo($redirectTo, 301);
        }

        return view('form.submitted')->with([
            'url' => $url,
        ]);
    }

    public function downloadSubmission(Submission $submission)
    {
        $this->authorize('export', $submission);

        $fileName = now()->unix() . '-' . auth()->user()->email . '-' . $submission->id . '.csv';

        $csv = Writer::createFromString();
        $csv->insertOne($submission->data->toArray());

        return response()->streamDownload(function () use ($csv) {
            echo $csv->getContent();
        }, $fileName, [
            'Content-Type' => 'text/csv'
        ]);
    }
}
