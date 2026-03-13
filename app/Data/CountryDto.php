<?php

namespace App\Data;

final readonly class CountryDto
{
    public function __construct(
        public string $name,
        public string $flagUrl,
    ) {}
}
