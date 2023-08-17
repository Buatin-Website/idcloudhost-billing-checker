<?php

use App\Http\Integrations\Idcloudhost\Requests\GetBillingAccountList;
use App\Livewire\BillingChecker;
use App\Settings\GeneralSettings;
use Saloon\Http\Faking\MockResponse;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

dataset('api_response', fn() => [
    yield fn() => [
        [
            'title' => fake()->name,
            'email' => fake()->email,
            'precalc_ongoing' => 100000,
        ],
        [
            'title' => fake()->name,
            'email' => fake()->email,
            'precalc_ongoing' => 100000,
        ],
    ]
]);

test('can\'t access home page without setup api key', function () {
    $response = get(route('home'));

    $response->assertRedirect(route('configure.index'));
});

test('can access home page with setup api key', function (GeneralSettings $generalSettings, array $api_response) {
    \Saloon\Laravel\Facades\Saloon::fake([
        GetBillingAccountList::class => MockResponse::make($api_response)
    ]);

    $response = get(route('home'));

    $response->assertOk();
    $response->assertViewIs('home');
    $response->assertSeeText('Billing Account List');
    $response->assertSeeText('Below is the list of billing accounts.');
    $response->assertSeeLivewire(BillingChecker::class);

    livewire(BillingChecker::class)
        ->assertViewHas('account_lists', $api_response);
})->with('api_key_setting', 'api_response');
