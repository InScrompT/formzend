<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function submit(Form $form)
    {
        return [
            $form,
            Request::all()
        ];
    }
}
