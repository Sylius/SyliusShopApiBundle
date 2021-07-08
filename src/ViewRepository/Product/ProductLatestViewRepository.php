<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\ViewRepository\Product;

use InvalidArgumentException;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Channel\Context\ChannelNotFoundException;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Core\Repository\ProductRepositoryInterface;
use Sylius\ShopApiPlugin\Factory\Product\ProductViewFactoryInterface;
use Sylius\ShopApiPlugin\Provider\SupportedLocaleProviderInterface;
use Sylius\ShopApiPlugin\View\Product\ProductListView;
use Webmozart\Assert\Assert;

final class ProductLatestViewRepository implements ProductLatestViewRepositoryInterface
{
    /** @var ProductRepositoryInterface */
    private $productRepository;

    /** @var ProductViewFactoryInterface */
    private $productViewFactory;

    /** @var SupportedLocaleProviderInterface */
    private $supportedLocaleProvider;

    /** @var ChannelContextInterface */
    private $channelContext;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductViewFactoryInterface $productViewFactory,
        SupportedLocaleProviderInterface $supportedLocaleProvider,
        ChannelContextInterface $channelContext
    ) {
        $this->productRepository = $productRepository;
        $this->productViewFactory = $productViewFactory;
        $this->supportedLocaleProvider = $supportedLocaleProvider;
        $this->channelContext = $channelContext;
    }

    public function getLatestProducts(?string $localeCode, int $count): ProductListView
    {
        try {
            /** @var ChannelInterface $channel */
            $channel = $this->channelContext->getChannel();
        } catch (ChannelNotFoundException $exception) {
            throw new InvalidArgumentException('Channel has not been found.');
        }
        $localeCode = $this->supportedLocaleProvider->provide($localeCode, $channel);
        $latestProducts = $this->productRepository->findLatestByChannel($channel, $localeCode, $count);

        Assert::notNull($latestProducts, sprintf('Latest Products not found in %s locale.', $localeCode));

        $productListView = new ProductListView();

        foreach ($latestProducts as $product) {
            $productListView->items[] = $this->productViewFactory->create($product, $channel, $localeCode);
        }

        return $productListView;
    }
}
