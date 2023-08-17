<?php

use App\Events\AccountThresholdReachedEvent;
use App\Http\Integrations\Idcloudhost\Requests\GetBillingAccountList;
use App\Settings\GeneralSettings;
use Saloon\Http\Faking\MockResponse;
use Symfony\Component\Console\Command\Command as CommandAlias;
use function Pest\Laravel\artisan;

test('can fetch billing accounts', function (GeneralSettings $generalSettings, array $api_response) {
    \Saloon\Laravel\Facades\Saloon::fake([
        GetBillingAccountList::class => MockResponse::make($api_response)
    ]);

    $response = artisan('fetch:billing-accounts');

    $response->assertOk();
    $response->assertExitCode(CommandAlias::SUCCESS);
})->with('api_key_setting', 'api_response');

test('can sent a notification when balance under threshold', function (GeneralSettings $generalSettings, array $api_response) {
    \Saloon\Laravel\Facades\Saloon::fake([
        GetBillingAccountList::class => MockResponse::make($api_response)
    ]);

    $generalSettings->balance_threshold = 100000;
    $generalSettings->save();

    Event::fake();
    $this->artisan('fetch:billing-accounts')->assertExitCode(CommandAlias::SUCCESS);
    Event::assertDispatched(AccountThresholdReachedEvent::class);
})->with('api_key_setting', 'api_response_low_balance');

test('not sent a notification when balance above threshold', function (GeneralSettings $generalSettings, array $api_response) {
    \Saloon\Laravel\Facades\Saloon::fake([
        GetBillingAccountList::class => MockResponse::make($api_response)
    ]);

    $generalSettings->balance_threshold = 0;
    $generalSettings->save();

    Event::fake();
    $this->artisan('fetch:billing-accounts')->assertExitCode(CommandAlias::SUCCESS);
    Event::assertNotDispatched(AccountThresholdReachedEvent::class);
})->with('api_key_setting', 'api_response');
