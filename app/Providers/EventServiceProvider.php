<?php

namespace App\Providers;

use App\Events\BookingCreated;
use App\Listeners\FollowUpCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


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
        'App\Events\ImportedEventCreated' => [
            'App\Listeners\ExtractEventDetails',
        ],
        'App\Events\ImportedEventUpdated' => [
            'App\Listeners\ExtractEventDetails',
        ],

        BookingCreated::class=>[
            FollowUpCreated::class,
        ]

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
