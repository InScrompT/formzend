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
Route::view('privacy', 'privacy')->name('privacy');
Route::view('terms', 'terms')->name('terms');
Route::view('contact', 'contact')->name('contact');
Route::view('refund', 'refund')->name('refund');

Route::get('auth/login', 'AuthController@showLogin')
    ->middleware('guest')
    ->name('login');
Route::get('auth/logout', 'AuthController@logout')
    ->middleware('auth')
    ->name('logout');
Route::get('auth/login/account/{account:id}', 'AuthController@loginUser')
    ->middleware('signed', 'guest')
    ->name('login.verify');

Route::get('verify/{account}/website/{website:id}', 'WebsiteController@verify')
    ->middleware('signed')
    ->name('website.verify');

Route::get('dashboard', 'DashboardController@show')
    ->name('dashboard');
Route::get('dashboard/unverified', 'DashboardController@unverified')
    ->name('dashboard.websites.unverified');
Route::get('dashboard/{account}/website/{website:id}/submissions', 'DashboardController@listSubmissions')
    ->name('dashboard.website.submissions');
Route::get('dashboard/{account}/website/{website:id}/submissions/{submission:id}', 'DashboardController@showSubmission')
    ->name('dashboard.website.submissions.show');

Route::get('download/{account}/submissions/{submission:id}', 'FormController@downloadSubmission')
    ->name('download.submission');
Route::get('download/{account}/website/{website:id}/submissions', 'DashboardController@exportSubmissions')
    ->name('download.submissions');

Route::get('plans', 'PaymentController@showPlans')->name('plans');
Route::get('plans/{plan}', 'PaymentController@buyPlan')->name('plans.buy');
Route::get('plans/payment/cancel', 'PaymentController@paymentCancelled')->name('plans.payment.cancelled');

Route::post('plans/payment/done', 'PaymentController@paymentCallback')->name('plans.payment.done');
Route::post('auth/login', 'AuthController@processLogin')
    ->middleware('csrf', 'guest');
Route::post('verify/resend/{account}/website/{website:id}', 'WebsiteController@resendVerification')
    ->middleware('csrf')
    ->name('website.verify.resend');
Route::post('/{email}', 'FormController@handleSubmission')
    ->middleware('check.email', 'check.email.verified', 'limiter')
    ->middleware('cors', 'check.email', 'check.email.verified')
    ->name('form');
