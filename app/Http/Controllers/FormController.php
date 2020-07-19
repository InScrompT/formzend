<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function handleSubmission($email) {
        return request()->all();
    }
}
