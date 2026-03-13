<?php

namespace App\Providers;

use App\Contracts\CountryDataSource;
use App\Services\Countries\CountryService;
use App\Services\Countries\RestCountries;
use Illuminate\Cache\CacheManager;
use Illuminate\Support\ServiceProvider;

class CountriesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(CountryDataSource::class, RestCountries::class);

        $this->app->singleton(CountryService::class, function ($app) {
            return new CountryService(
                $app->make(CountryDataSource::class),
                $app->make(CacheManager::class),
                config('countries.cache_key'),
                config('countries.cache_ttl'),
            );
        });
    }
}
