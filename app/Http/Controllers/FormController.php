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
            \request()->all()
        ));

        return view('form.submitted')->with([
            'url' => $url
        ]);
    }
}
