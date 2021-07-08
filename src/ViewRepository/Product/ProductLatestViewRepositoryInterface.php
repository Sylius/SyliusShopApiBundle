<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\ViewRepository\Product;

use Sylius\ShopApiPlugin\View\Product\ProductListView;

interface ProductLatestViewRepositoryInterface
{
    public function getLatestProducts(?string $localeCode, int $count): ProductListView;
}
