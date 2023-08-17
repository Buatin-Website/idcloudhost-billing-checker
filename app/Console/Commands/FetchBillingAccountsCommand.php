<?php

namespace App\Console\Commands;

use App\Events\AccountThresholdReachedEvent;
use App\Http\Integrations\Idcloudhost\Requests\GetBillingAccountList;
use App\Settings\GeneralSettings;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class FetchBillingAccountsCommand extends Command
{
    protected $signature = 'fetch:billing-accounts';

    protected $description = 'Fetch billing accounts';

    public function handle(): int
    {
        $generalSettings = new GeneralSettings();

        $request = new GetBillingAccountList();
        $request->invalidateCache();
        $response = $request->send();

        $account_lists = $response->collect();

        // account balance reached threshold
        $account_under_threshold = $account_lists->filter(fn($account) => $account['precalc_ongoing'] < $generalSettings->balance_threshold);
        if ($account_under_threshold->count()) {
            AccountThresholdReachedEvent::dispatch($account_under_threshold->toArray());
        }

        return CommandAlias::SUCCESS;
    }
}
