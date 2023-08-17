<?php

namespace App\Livewire;

use App\Events\AccountThresholdReachedEvent;
use App\Http\Integrations\Idcloudhost\Requests\GetBillingAccountList;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class BillingChecker extends Component
{
    protected array $account_lists = [];

    public function mount(GeneralSettings $generalSettings): void
    {
        $this->fetchBillingAccounts();

        $account_lists = collect($this->account_lists);

        // account balance reached threshold
        $account_under_threshold = $account_lists->filter(fn($account) => $account['precalc_ongoing'] < $generalSettings->balance_threshold);
        if ($account_under_threshold->count()) {
            AccountThresholdReachedEvent::dispatch($account_under_threshold->toArray());
        }
    }

    public function fetchBillingAccounts(): void
    {
        $request = new GetBillingAccountList();
        $request->invalidateCache();
        $response = $request->send();

        $account_lists = $response->collect();

        $this->account_lists = $account_lists->toArray();
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.billing-checker', [
            'account_lists' => $this->account_lists,
        ]);
    }
}
