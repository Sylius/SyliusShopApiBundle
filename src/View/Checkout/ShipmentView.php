<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\View\Checkout;

use Sylius\ShopApiPlugin\View\Cart\ShippingMethodView;

class ShipmentView
{
    /** @var string */
    public $state;

    /** @var ShippingMethodView */
    public $method;

    /** @var string */
    public $track;

    /** @var \DateTimeInterface|null */
    public $updatedAt;

    public function __construct()
    {
        $this->method = new ShippingMethodView();
    }
}
