<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Factory\Country;

use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\ShopApiPlugin\View\Country\CountryView;

interface CountryViewFactoryInterface
{
    public function create(CountryInterface $country): CountryView;
}
