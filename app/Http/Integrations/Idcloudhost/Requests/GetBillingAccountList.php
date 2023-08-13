<?php

namespace App\Http\Integrations\Idcloudhost\Requests;

use App\Http\Integrations\Idcloudhost\IdcloudhostConnector;
use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\HasConnector;

class GetBillingAccountList extends Request implements Cacheable
{
    use HasConnector, HasCaching;

    protected string $connector = IdcloudhostConnector::class;

    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/payment/billing_account/list';
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        $generalSettings = new GeneralSettings();

        return [
            'apikey' => $generalSettings->api_key,
        ];
    }

    public function resolveCacheDriver(): LaravelCacheDriver
    {
        return new LaravelCacheDriver(Cache::store('file'));
    }

    public function cacheExpiryInSeconds(): int
    {
        // 15 Minutes
        return 60 * 15;
    }
}
