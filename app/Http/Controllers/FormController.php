<?php

namespace App\Http\Controllers;

use App\Account;
use App\Events\FormSubmission;

class FormController extends Controller
{
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
        $canRedirect = $isValidRedirect && !(intval($account->plan_id) === 1);

        if ($canRedirect) {
            return response()->redirectTo($redirectTo, 301);
        }

        return view('form.submitted')->with([
            'url' => $isValidRedirect ? $redirectTo : $url,
        ]);
    }
}
