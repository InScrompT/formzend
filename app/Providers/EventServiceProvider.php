<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\NewWebsite::class => [
            \App\Listeners\SendVerification::class,
        ],
        \App\Events\FormSubmission::class => [
            \App\Listeners\IncreaseUsageCount::class,
            \App\Listeners\SendFormData::class,
            \App\Listeners\SaveFormData::class,
        ],
        \App\Events\LoginRequest::class => [
            \App\Listeners\SendLoginVerification::class
        ],
        \App\Events\PaymentProcessed::class => [
            \App\Listeners\SendPaymentInvoice::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
