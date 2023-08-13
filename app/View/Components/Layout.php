<?php

namespace App\View\Components;

use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    public function render(): View
    {
        $data = [
            'app_name' => config('app.name'),
            'author' => config('nativephp.author'),
        ];

        return view('components.layout', $data);
    }
}
