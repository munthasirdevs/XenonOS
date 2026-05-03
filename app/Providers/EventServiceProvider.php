<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        'App\Events\UserLoggedIn' => [
            'App\Listeners\LogAuthActivity',
        ],
        'App\Events\UserRegistered' => [
            'App\Listeners\LogAuthActivity',
        ],
        'App\Events\UserLoggedOut' => [
            'App\Listeners\LogAuthActivity',
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}