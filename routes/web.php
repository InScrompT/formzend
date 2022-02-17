<?php

use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');
Route::view('dashboard', 'dashboard')
    ->name('dashboard')->middleware('auth');

Route::prefix('auth')->group(function () {
    Route::view('login', 'auth.login')
        ->name('auth.login')->middleware('guest');
    Route::view('register', 'auth.register')
        ->name('auth.register')->middleware('guest');

    Route::get('logout', [\App\Http\Controllers\AuthController::class, 'logout'])
        ->name('auth.logout');
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::post('register', [\App\Http\Controllers\AuthController::class, 'register']);
});

$domain = 'send.' . parse_url(config('app.url'), PHP_URL_HOST);
Route::domain($domain)->group(function () {
    Route::post('{form}', [SubmissionController::class, 'submit'])->name('form.submit');
});
