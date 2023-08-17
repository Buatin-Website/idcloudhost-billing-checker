<?php

use App\Settings\GeneralSettings;

dataset('api_key_setting', fn() => [
    yield function () {
        $setting = new GeneralSettings();
        $setting->api_key = fake()->sha256;
        $setting->save();

        return $setting;
    }
]);
