<?php

namespace App\Providers;

use App\Account;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\Razorpay\Api\Api::class, function () {
            return new \Razorpay\Api\Api(config('razorpay.api.key'), config('razorpay.api.secret'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('user', function () {
            return request()->session()->has('loggedIn');
        });

        Blade::if('guest', function () {
            return !request()->session()->has('loggedIn');
        });

        View::composer(['dashboard.*', 'plans.*'], function ($view) {
            if (!request()->session()->has('loggedIn')) {
                return $view->with('user', null);
            }

            $account = Account::whereEmail(session('email'))->firstOrFail();
            return $view->with('user', $account);
        });
    }
}
