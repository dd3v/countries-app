<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CountryResource;
use App\Services\Countries\CountryService;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    public function __construct(
        private readonly CountryService $countryService,
    ) {}

    public function index(): JsonResponse
    {
        $countries = $this->countryService->getAll();

        return CountryResource::collection($countries)
            ->response()
            ->header('Cache-Control', 'private, max-age='.$this->countryService->getCacheTtl());
    }
}
