<?php

declare(strict_types=1);

namespace Tests\Sylius\ShopApiPlugin\DependencyInjection;

use Matthias\SymfonyConfigTest\PhpUnit\ConfigurationTestCaseTrait;
use PHPUnit\Framework\TestCase;
use Sylius\ShopApiPlugin\DependencyInjection\Configuration;
use Sylius\ShopApiPlugin\View;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class ConfigurationTest extends TestCase
{
    use ConfigurationTestCaseTrait;

    /**
     * @test
     */
    public function it_processed_attribute_codes_which_should_be_serialized(): void
    {
        $this->assertProcessedConfigurationEquals(
            [[
                'included_attributes' => [
                    'FIRST_CODE',
                    'SECOND_CODE',
                ],
            ]],
            [
                'included_attributes' => [
                    'FIRST_CODE',
                    'SECOND_CODE',
                ],
            ],
            'included_attributes'
        );
    }

    /**
     * @test
     */
    public function it_processed_empty_attribute_codes_list_and_returns_empty_array(): void
    {
        $this->assertProcessedConfigurationEquals([], ['included_attributes' => []], 'included_attributes');
    }

    /**
     * @test
     */
    public function it_has_view_classes(): void
    {
        $this->assertProcessedConfigurationEquals([], [
            'view_classes' => [
                'address' => View\AddressBook\AddressView::class,
                'adjustment' => View\Cart\AdjustmentView::class,
                'cart_item' => View\ItemView::class,
                'cart_summary' => View\Cart\CartSummaryView::class,
                'country' => View\Country\CountryView::class,
                'customer' => View\Customer\CustomerView::class,
                'estimated_shipping_cost' => View\Cart\EstimatedShippingCostView::class,
                'image' => View\ImageView::class,
                'page' => View\Product\PageView::class,
                'page_links' => View\Product\PageLinksView::class,
                'payment' => View\Cart\PaymentView::class,
                'payment_method' => View\Cart\PaymentMethodView::class,
                'placed_order' => View\Order\PlacedOrderView::class,
                'price' => View\PriceView::class,
                'product' => View\Product\ProductView::class,
                'product_attribute_value' => View\Product\ProductAttributeValueView::class,
                'product_review' => View\Product\ProductReviewView::class,
                'product_taxon' => View\Product\ProductTaxonView::class,
                'product_variant' => View\Product\ProductVariantView::class,
                'province' => View\Country\ProvinceView::class,
                'shipment' => View\Checkout\ShipmentView::class,
                'shipping_method' => View\Cart\ShippingMethodView::class,
                'taxon' => View\Taxon\TaxonView::class,
                'taxon_details' => View\Taxon\TaxonDetailsView::class,
                'totals' => View\Cart\TotalsView::class,
                'validation_error' => View\ValidationErrorView::class,
                'variant_option' => View\Product\VariantOptionView::class,
                'variant_option_value' => View\Product\VariantOptionValueView::class,
            ],
        ], 'view_classes');
    }

    /**
     * {@inheritdoc}
     */
    protected function getConfiguration(): ConfigurationInterface
    {
        return new Configuration();
    }
}
