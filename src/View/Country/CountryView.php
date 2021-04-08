<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\View\Country;

class CountryView
{
    /** @var string */
    public $code;

    /** @var bool */
    public $enabled;

    /** @var array */
    public $provinces = [];
}
