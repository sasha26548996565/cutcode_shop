<?php

namespace App\Providers;

use App\Events\OrderShipped;
use App\Events\UserRegistered;
use Illuminate\Auth\Events\Registered;
use App\Listeners\AddRegisteredUserToCart;
use App\Listeners\AddRegisteredUserToWishlist;
use App\Listeners\SendOrderShipp;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRegistered::class => [
            AddRegisteredUserToCart::class,
            AddRegisteredUserToWishlist::class,
        ],
        OrderShipped::class => [
            SendOrderShipp::class
        ]
    ];
}
