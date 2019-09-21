<?php

declare(strict_types=1);

namespace Tests\Sylius\ShopApiPlugin\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Sylius\ShopApiPlugin\DependencyInjection\SyliusShopApiExtension;
use Sylius\ShopApiPlugin\View;

final class ShopApiExtensionTest extends AbstractExtensionTestCase
{
    /**
     * @test
     */
    public function it_sets_up_parameter_with_attributes_to_serialize(): void
    {
        $this->setParameter('kernel.bundles', []);
        $this->load([
            'included_attributes' => [
                'ATTRIBUTE_CODE',
            ],
        ]);

        $this->assertContainerBuilderHasParameter('sylius.shop_api.included_attributes', ['ATTRIBUTE_CODE']);
    }

    /**
     * @test
     */
    public function it_defines_view_classes_parameters(): void
    {
        $this->setParameter('kernel.bundles', []);
        $this->load([]);

        $nameToClass = [
            'address' => View\AddressBook\AddressView::class,
            'adjustment' => View\Cart\AdjustmentView::class,
            'cart_item' => View\ItemView::class,
            'cart_summary' => View\Cart\CartSummaryView::class,
            'estimated_shipping_cost' => View\Cart\EstimatedShippingCostView::class,
            'image' => View\Taxon\ImageView::class,
            'page' => View\Product\PageView::class,
            'page_links' => View\Product\PageLinksView::class,
            'payment' => View\Cart\PaymentView::class,
            'payment_method' => View\Cart\PaymentMethodView::class,
            'price' => View\PriceView::class,
            'product' => View\Product\ProductView::class,
            'product_attribute_value' => View\Product\ProductAttributeValueView::class,
            'product_review' => View\Product\ProductReviewView::class,
            'product_taxon' => View\Product\ProductTaxonView::class,
            'product_variant' => View\Product\ProductVariantView::class,
            'shipment' => View\Checkout\ShipmentView::class,
            'shipping_method' => View\Cart\ShippingMethodView::class,
            'taxon' => View\Taxon\TaxonView::class,
            'taxon_details' => View\Taxon\TaxonDetailsView::class,
            'totals' => View\Cart\TotalsView::class,
            'validation_error' => View\ValidationErrorView::class,
            'variant_option' => View\Product\VariantOptionView::class,
            'variant_option_value' => View\Product\VariantOptionValueView::class,
        ];

        foreach ($nameToClass as $name => $class) {
            $this->assertContainerBuilderHasParameter(
                sprintf('sylius.shop_api.view.%s.class', $name),
                $class
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensions(): array
    {
        return [new SyliusShopApiExtension()];
    }
}
