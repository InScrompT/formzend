<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebsiteController;
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

Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::get('login', 'showLogin')
            ->middleware('guest')
            ->name('login');
        Route::get('logout', 'logout')
            ->middleware('auth')
            ->name('logout');
        Route::get('login/account/{account:id}/key/{key}', 'loginUser')
            ->middleware('guest')
            ->name('login.verify');
    });

Route::prefix('verify')
    ->controller(WebsiteController::class)
    ->group(function () {
        Route::get('account/{account:id}/website/{website:id}/remind', 'remindVerification')
            ->name('website.verify.remind');
        Route::get('website/{link}/email/{email}', 'showVerificationNotice')
            ->name('website.verify.show');
        Route::get('website/{website:id}/key/{key}', 'verify')
            ->name('website.verify');
        Route::get('resend/website/{website:id}', 'resendVerification')
            ->name('website.verify.resend');
    });

Route::prefix('dashboard')
    ->controller(DashboardController::class)
    ->group(function () {
        Route::get('/', 'show')
            ->name('dashboard');
        Route::get('unverified', 'unverified')
            ->name('dashboard.websites.unverified');
        Route::get('website/{website:id}/submissions', 'listSubmissions')
            ->name('dashboard.website.submissions');
        Route::get('submissions/{submission:id}', 'showSubmission')
            ->name('dashboard.website.submissions.show');
    });

Route::get('download/submissions/{submission:id}', [FormController::class, 'downloadSubmission'])
    ->name('download.submission');
Route::get('download/website/{website:id}/submissions', [DashboardController::class, 'exportSubmissions'])
    ->name('download.submissions');

Route::prefix('plans')
    ->controller(PaymentController::class)
    ->group(function () {
        Route::get('/', 'showPlans')->name('plans');
        Route::get('{plan}', 'buyPlan')->name('plans.buy');
        Route::get('payment/cancel', 'paymentCancelled')->name('plans.payment.cancelled');

        Route::post('payment/done', 'paymentCallback')->name('plans.payment.done');
    });

Route::get('profile', [ProfileController::class, 'showProfile'])->name('profile');

Route::post('auth/login', [AuthController::class, 'processLogin'])
    ->middleware('csrf', 'guest');
Route::post('/{email}', [FormController::class, 'handleSubmission'])
    ->middleware('check.email', 'check.email.verified')
    ->name('form');
