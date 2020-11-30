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
Route::get('auth/login/account/{account:id}/key/{key}', 'AuthController@loginUser')
    ->middleware('guest')
    ->name('login.verify');

Route::get('verify/website/{website:id}/key/{key}', 'WebsiteController@verify')
    ->name('website.verify');
Route::get('verify/resend/website/{website:id}', 'WebsiteController@resendVerification')
    ->name('website.verify.resend');

Route::get('dashboard', 'DashboardController@show')
    ->name('dashboard');
Route::get('dashboard/unverified', 'DashboardController@unverified')
    ->name('dashboard.websites.unverified');
Route::get('dashboard/website/{website:id}/submissions', 'DashboardController@listSubmissions')
    ->name('dashboard.website.submissions');
Route::get('dashboard/submissions/{submission:id}', 'DashboardController@showSubmission')
    ->name('dashboard.website.submissions.show');

Route::get('download/submissions/{submission:id}', 'FormController@downloadSubmission')
    ->name('download.submission');
Route::get('download/website/{website:id}/submissions', 'DashboardController@exportSubmissions')
    ->name('download.submissions');

Route::get('plans', 'PaymentController@showPlans')->name('plans');
Route::get('plans/{plan}', 'PaymentController@buyPlan')->name('plans.buy');
Route::get('plans/payment/cancel', 'PaymentController@paymentCancelled')->name('plans.payment.cancelled');

Route::post('plans/payment/done', 'PaymentController@paymentCallback')->name('plans.payment.done');
Route::post('auth/login', 'AuthController@processLogin')
    ->middleware('csrf', 'guest');
Route::post('/{email}', 'FormController@handleSubmission')
    ->middleware('cors', 'check.email', 'check.email.verified')
    ->name('form');
