<?php

declare(strict_types=1);

namespace spec\Sylius\ShopApiPlugin\ViewRepository\Cart;

use PhpSpec\ObjectBehavior;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\ShopApiPlugin\Factory\Country\CountryViewFactoryInterface;
use Sylius\ShopApiPlugin\View\Country\CountryView;
use Sylius\ShopApiPlugin\ViewRepository\Country\CountryViewRepositoryInterface;

final class CountryViewRepositorySpec extends ObjectBehavior
{
    function let(RepositoryInterface $countryRepository, CountryViewFactoryInterface $countryViewFactory): void
    {
        $this->beConstructedWith($countryRepository, $countryViewFactory);
    }

    function it_is_country_query(): void
    {
        $this->shouldImplement(CountryViewRepositoryInterface::class);
    }

    function it_provides_cart_view(
        RepositoryInterface $countryRepository,
        CountryViewFactoryInterface $countryViewFactory,
        CountryInterface $country,
        CountryView $countryView
    ): void {
        $countryRepository->findOneBy(['code' => 'US'])->willReturn($country);
        $country->getCode()->willReturn('US');

        $countryViewFactory->create($country)->willReturn($countryView);
    }
}
