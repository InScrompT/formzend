<?php

namespace App\Http\Controllers;

use App\Account;
use App\Submission;
use League\Csv\Writer;
use App\Events\FormSubmission;
use App\Events\CreditsExhausted;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('handleSubmission');
    }

    public function handleSubmission($email)
    {
        $url = request()->headers->get('referer');
        $account = Account::firstWhere('email', $email);
        $website = $account->websites->firstWhere('url', $url);

        if ($account->cant('create', Submission::class)) {
            event(new CreditsExhausted($account));

            return response()->view('website.error', [
                'title' => 'Credits Exhausted',
                'error' => 'The owner has exhausted the credits. If you\'re the owner, go to dashboard and top-up credits'
            ], 401);
        }

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
            echo $csv->toString();
        }, $fileName, [
            'Content-Type' => 'text/csv'
        ]);
    }
}
