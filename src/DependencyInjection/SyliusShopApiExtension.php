<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\DependencyInjection;

use Psr\Log\LoggerInterface;
use Sylius\Bundle\ShopBundle\SyliusShopBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

final class SyliusShopApiExtension extends Extension
{
    /** {@inheritdoc} */
    public function load(array $config, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $config);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        foreach ($config['view_classes'] as $view => $class) {
            $container->setParameter(sprintf('sylius.shop_api.view.%s.class', $view), $class);
        }

        foreach ($config['request_classes'] as $request => $class) {
            $container->setParameter(sprintf('sylius.shop_api.request.%s.class', $request), $class);
        }

        $container->setParameter('sylius.shop_api.included_attributes', $config['included_attributes']);

        $loader->load('services.xml');

        if (in_array(SyliusShopBundle::class, $container->getParameter('kernel.bundles'))) {
            /** @var LoggerInterface $logger */
            $logger = $container->get('sylius.shop_api_plugin.logger.console');
            $logger->notice('Beware! SyliusShopApi is not built to work with SyliusShopBundle.');
        }
    }
}
