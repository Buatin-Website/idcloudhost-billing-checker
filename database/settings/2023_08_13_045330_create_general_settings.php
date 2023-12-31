<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.api_key');
        $this->migrator->add('general.balance_threshold', 0);
    }
};
