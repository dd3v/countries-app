<?php

namespace App\Services\Countries;

use App\Contracts\CountryDataSource;
use App\Data\CountryDto;
use Illuminate\Cache\CacheManager;

class CountryService
{
    public function __construct(
        private readonly CountryDataSource $dataSource,
        private readonly CacheManager $cache,
        private readonly string $cacheKey,
        private readonly int $cacheTtl,
    ) {}

    public function getCacheTtl(): int
    {
        return $this->cacheTtl;
    }

    /** @return array<int, CountryDto> */
    public function getAll(): array
    {
        return $this->cache->remember($this->cacheKey, $this->cacheTtl, fn () => $this->dataSource->getAll());
    }
}
