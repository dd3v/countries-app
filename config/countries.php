<?php

return [
    'cache_key' => env('COUNTRIES_CACHE_KEY', 'countries:all'),
    'cache_ttl' => (int) env('COUNTRIES_CACHE_TTL', 3600),
];
