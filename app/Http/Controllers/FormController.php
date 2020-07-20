<?php

namespace App\Http\Controllers;

use App\Account;
use App\Mail\FormSubmission;

class FormController extends Controller
{
    public function handleSubmission($email) {
        $url = \request()->getSchemeAndHttpHost();
        $account = Account::firstWhere('email', $email);
        $website = $account->websites->firstWhere('url', $url);

        \Mail::send(new FormSubmission($website, [
            'url' => $url,
            'form' => \request()->all()
        ]));

        return view('form.submitted')->with([
            'url' => $url
        ]);
    }
}
