<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Factory\Country;

use Sylius\Component\Addressing\Model\ProvinceInterface;
use Sylius\ShopApiPlugin\View\Country\ProvinceView;

interface ProvinceViewFactoryInterface
{
    public function create(ProvinceInterface $country): ProvinceView;
}
