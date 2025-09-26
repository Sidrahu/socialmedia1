<?php

namespace App\Providers;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\UserOnline;
use App\Listeners\UserOffline;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
 

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            UserOnline::class,
        ],
        Logout::class => [
            UserOffline::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
