<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');

Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');

Route::get('/verify/{account}/website/{website:id}', 'WebsiteController@verify')
    ->middleware('signed')
    ->name('website.verify');

Route::post('/verify/resend/{account}/website/{website:id}', 'WebsiteController@resendVerification')
    ->middleware('csrf')
    ->name('website.verify.resend');
Route::post('/{email}', 'FormController@handleSubmission')
    ->middleware('cors', 'check.email', 'check.email.verified')
    ->name('form');
