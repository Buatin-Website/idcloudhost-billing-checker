<?php

namespace App\Http\Controllers;

use App\Events\AccountThresholdReachedEvent;
use App\Http\Integrations\Idcloudhost\Requests\GetBillingAccountList;
use App\Settings\GeneralSettings;

class HomeController extends Controller
{
    public function __invoke(GeneralSettings $generalSettings)
    {
        $request = new GetBillingAccountList();
        $response = $request->send();

        $account_lists = $response->collect();

        // account balance reached threshold
        $account_under_threshold = $account_lists->filter(fn($account) => $account['precalc_ongoing'] < $generalSettings->balance_threshold);
        AccountThresholdReachedEvent::dispatch($account_under_threshold->toArray());

        $data = [
            'account_lists' => $account_lists,
        ];

        return view('home', $data);
    }
}
