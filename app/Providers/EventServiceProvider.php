<?php

namespace App\Providers;

use App\Models\Group;
use App\Models\GroupMember;
use App\Models\PaymentTransaction;
use App\Models\User;
use App\Observers\GroupMemberObserver;
use App\Observers\GroupObserver;
use App\Observers\PaymentTransactionObserver;
use App\Observers\UserObserver;
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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Group::observe(GroupObserver::class);
        GroupMember::observe(GroupMemberObserver::class);
        PaymentTransaction::observe(PaymentTransactionObserver::class);
    }
}
