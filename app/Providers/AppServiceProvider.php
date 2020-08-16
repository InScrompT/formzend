<?php

namespace App\Providers;

use App\Account;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        //
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

        View::composer(['dashboard.*'], function ($view) {
            if (!request()->session()->has('loggedIn')) {
                return $view->with('user', null);
            }

            $account = Account::whereEmail(session('email'))->firstOrFail();
            return $view->with('user', $account);
        });
    }
}
