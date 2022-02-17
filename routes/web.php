<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

$domain = 'send.' . parse_url(config('app.url'), PHP_URL_HOST);
Route::domain($domain)->group(function () {
    Route::post('{form}', [SubmissionController::class, 'submit'])->name('form.submit');
});
