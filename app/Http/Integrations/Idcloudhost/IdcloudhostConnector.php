<?php

namespace App\Http\Integrations\Idcloudhost;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class IdcloudhostConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return config('idcloudhost.base_url');
    }

    /**
     * Default HTTP client options
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
