<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\ViewRepository\Country;

interface CountryViewRepositoryInterface
{
    public function getAllCountries(): array;
}
