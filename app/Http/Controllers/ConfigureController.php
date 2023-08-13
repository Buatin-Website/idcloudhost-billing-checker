<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConfigurationRequest;
use App\Settings\GeneralSettings;

class ConfigureController extends Controller
{
    public function index(GeneralSettings $generalSettings)
    {
        $data = [
            'api_key' => $generalSettings->api_key,
        ];

        return view('configure', $data);
    }

    public function store(StoreConfigurationRequest $request)
    {
        $generalSettings = new GeneralSettings();
        $generalSettings->fill($request->validated());
        $generalSettings->save();

        return redirect()->route('home');
    }
}
