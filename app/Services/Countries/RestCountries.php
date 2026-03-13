<?php

namespace App\Services\Countries;

use App\Contracts\CountryDataSource;
use App\Data\CountryDto;
use App\Exceptions\CountriesUnavailableException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class RestCountries implements CountryDataSource
{
    private const BASE_URL = 'https://restcountries.com/v3.1';

    public function getAll(): array
    {
        try {
            $response = Http::timeout(10)
                ->retry(2, 100)
                ->get(self::BASE_URL.'/all', ['fields' => 'name,flags'])
                ->throw();
        } catch (RequestException $e) {
            throw new CountriesUnavailableException('Countries API is unavailable.', previous: $e);
        }

        $countries = array_map(
            fn (object $country): CountryDto => new CountryDto(
                name: $country->name->common,
                flagUrl: $country->flags->png ?? '',
            ),
            $response->object()
        );

        usort($countries, fn (CountryDto $a, CountryDto $b) => strcmp($a->name, $b->name));

        return $countries;
    }
}
