<?php

namespace App\Listeners;

use App\Events\AccountThresholdReachedEvent;
use App\Settings\GeneralSettings;
use Native\Laravel\Facades\Notification;

class AccountThresholdReachedListener
{
    public function __construct()
    {
    }

    public function handle(AccountThresholdReachedEvent $event): void
    {
        $generalSettings = new GeneralSettings();
        $balance_threshold = number_format($generalSettings->balance_threshold);

        $accounts = $event->accounts;
        foreach ($accounts as $account) {
            $balance = number_format($account['precalc_ongoing']);
            Notification::title('Account Threshold Reached')
                ->message('Account ' . $account['title'] . ' has gone below the threshold of ' . $balance_threshold . ' with a balance of ' . $balance)
                ->show();
        }
    }
}
