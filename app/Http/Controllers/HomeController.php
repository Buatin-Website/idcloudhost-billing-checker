<?php

namespace App\Http\Controllers;

use App\Http\Integrations\Idcloudhost\Requests\GetBillingAccountList;
use App\Settings\GeneralSettings;

class HomeController extends Controller
{
    public function __invoke(GeneralSettings $generalSettings)
    {
        $request = new GetBillingAccountList();
        $response = $request->send();

        $account_lists = $response->collect();

        $data = [
            'account_lists' => $account_lists,
        ];

        return view('home', $data);
    }
}
