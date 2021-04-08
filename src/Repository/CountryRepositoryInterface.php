<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Repository;

use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface CountryRepositoryInterface extends RepositoryInterface
{
    /**
     * @return array|CountryInterface[]
     */
    public function findAll(): array;
}
