<?php

namespace App\Listeners;

use Native\Laravel\Events\App\ApplicationBooted;
use Native\Laravel\Facades\Notification;

class ApplicationBootedListener
{
    public function __construct()
    {
    }

    public function handle(ApplicationBooted $event): void
    {
        Notification::title(config('app.name') . ' is ready to use!')
            ->message(config('app.name') . ' will be running in the background and will notify you when your account billing is under a threshold.')
            ->show();
    }
}
