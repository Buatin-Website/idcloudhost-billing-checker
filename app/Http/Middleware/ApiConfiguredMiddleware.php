<?php

namespace App\Http\Middleware;

use App\Settings\GeneralSettings;
use Closure;
use Illuminate\Http\Request;

class ApiConfiguredMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $generalSettings = new GeneralSettings();
        if (!$generalSettings->api_key) {
            return redirect()->route('configure.index');
        }

        return $next($request);
    }
}
