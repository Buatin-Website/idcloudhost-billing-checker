<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use Native\Laravel\Events\App\ApplicationBooted;
use Native\Laravel\Facades\MenuBar;

class ApplicationBootedListener
{
    public function __construct()
    {
    }

    public function handle(ApplicationBooted $event): void
    {
        Cache::forget('menu-bar-hidden');
        MenuBar::show();
    }
}
