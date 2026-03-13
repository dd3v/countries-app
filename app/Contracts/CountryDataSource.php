<?php

namespace App\Contracts;

use App\Data\CountryDto;

interface CountryDataSource
{
    /**
     * @return array<int, CountryDto>
     */
    public function getAll(): array;
}
