<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $api_key = null;
    public int $balance_threshold = 0;

    public static function group(): string
    {
        return 'general';
    }
}
