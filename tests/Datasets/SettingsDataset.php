<?php

use App\Settings\GeneralSettings;

dataset('general_settings', fn() => [
    yield function () {
        $setting = new GeneralSettings();
        $setting->api_key = fake()->sha256;
        $setting->balance_threshold = 100000;
        $setting->save();

        return $setting;
    }
]);

dataset('api_key_setting', fn() => [
    yield function () {
        $setting = new GeneralSettings();
        $setting->api_key = fake()->sha256;
        $setting->save();

        return $setting;
    }
]);
