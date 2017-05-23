<?php

namespace Sylius\ShopApiPlugin\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

final class TokenAlreadyTaken extends Constraint
{
    /**
     * @var string
     */
    public $message = 'sylius.shop_api.pickup_cart_request.token.already_taken';

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'sylius_shop_api_token_already_taken_validator';
    }
}