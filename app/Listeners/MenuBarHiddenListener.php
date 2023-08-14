<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use Native\Laravel\Events\MenuBar\MenuBarHidden;
use Native\Laravel\Facades\Notification;

class MenuBarHiddenListener
{
    public function __construct()
    {
    }

    public function handle(MenuBarHidden $event): void
    {
        if (Cache::get('menu-bar-hidden') === true) {
            return;
        }

        Cache::rememberForever('menu-bar-hidden', function () {
            return true;
        });

        Notification::title(config('app.name') . ' is running in the background')
            ->message(config('app.name') . ' will notify you when your account billing is under a threshold.')
            ->show();
    }
}
