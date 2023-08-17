<?php

use App\Settings\GeneralSettings;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

test('can access configuration page', function (GeneralSettings $generalSettings) {
    $response = get(route('configure.index'));

    $response->assertViewIs('configure');
    $response->assertSeeText(['API Key', 'Balance Threshold']);
    $response->assertViewHas([
        'api_key' => $generalSettings->api_key,
        'balance_threshold' => $generalSettings->balance_threshold,
    ]);
})->with('general_settings');

test('can\'t update configuration (validation failed)', function (GeneralSettings $generalSettings) {
    $response = post(route('configure.store'));

    $response->assertRedirect();
    $response->assertSessionHasErrors(['api_key', 'balance_threshold']);
})->with('general_settings');

test('can update configuration', function (GeneralSettings $generalSettings) {
    $payload = [
        'api_key' => fake()->sha256,
        'balance_threshold' => fake()->numberBetween(100000, 1000000),
    ];

    $response = post(route('configure.store'), $payload);

    $response->assertRedirect(route('home'));
    $response->assertSessionDoesntHaveErrors();

    $generalSettings->refresh();
    expect($generalSettings)
        ->api_key->toBe($payload['api_key'])
        ->balance_threshold->toBe($payload['balance_threshold']);
})->with('general_settings');
