<?php

namespace App\Providers;

use App\Events\AccountThresholdReachedEvent;
use App\Listeners\AccountThresholdReachedListener;
use App\Listeners\ApplicationBootedListener;
use App\Listeners\MenuBarHiddenListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Native\Laravel\Events\App\ApplicationBooted;
use Native\Laravel\Events\MenuBar\MenuBarHidden;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AccountThresholdReachedEvent::class => [
            AccountThresholdReachedListener::class,
        ],
        ApplicationBooted::class => [
            ApplicationBootedListener::class,
        ],
        MenuBarHidden::class => [
            MenuBarHiddenListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
