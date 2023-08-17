<?php

use App\Events\AccountThresholdReachedEvent;
use App\Http\Integrations\Idcloudhost\Requests\GetBillingAccountList;
use App\Livewire\BillingChecker;
use App\Settings\GeneralSettings;
use Saloon\Http\Faking\MockResponse;
use function Pest\Laravel\get;
use function Pest\Livewire\livewire;

test('can\'t access home page without setup api key', function () {
    $response = get(route('home'));

    $response->assertRedirect(route('configure.index'));
});

test('can access home page with setup api key', function (GeneralSettings $generalSettings, array $api_response) {
    \Saloon\Laravel\Facades\Saloon::fake([
        GetBillingAccountList::class => MockResponse::make($api_response)
    ]);

    $response = get(route('home'));

    $response->assertViewIs('home');
    $response->assertSeeText('Billing Account List');
    $response->assertSeeText('Below is the list of billing accounts.');
    $response->assertSeeLivewire(BillingChecker::class);

    livewire(BillingChecker::class)
        ->assertViewHas('account_lists', $api_response);
})->with('api_key_setting', 'api_response');

test('access home page with low balance will trigger event', function (GeneralSettings $generalSettings, array $api_response) {
    \Saloon\Laravel\Facades\Saloon::fake([
        GetBillingAccountList::class => MockResponse::make($api_response)
    ]);

    $generalSettings->balance_threshold = 100000;
    $generalSettings->save();

    Event::fake();
    $response = get(route('home'));
    $response->assertViewIs('home');
    $response->assertSeeText('Billing Account List');
    $response->assertSeeText('Below is the list of billing accounts.');
    $response->assertSeeLivewire(BillingChecker::class);

    livewire(BillingChecker::class)
        ->assertViewHas('account_lists', $api_response);
    Event::assertDispatched(AccountThresholdReachedEvent::class);
})->with('api_key_setting', 'api_response_low_balance');
