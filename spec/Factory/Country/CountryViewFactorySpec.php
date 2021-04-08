<?php

declare(strict_types=1);

namespace spec\Sylius\ShopApiPlugin\Factory\Country;

use Doctrine\Common\Collections\ArrayCollection;
use PhpSpec\ObjectBehavior;
use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Addressing\Model\ProvinceInterface;
use Sylius\ShopApiPlugin\Factory\Country\CountryViewFactoryInterface;
use Sylius\ShopApiPlugin\Factory\Country\ProvinceViewFactoryInterface;
use Sylius\ShopApiPlugin\View\Country\CountryView;
use Sylius\ShopApiPlugin\View\Country\ProvinceView;

final class CountryViewFactorySpec extends ObjectBehavior
{
    function let(ProvinceViewFactoryInterface $provinceViewFactory): void
    {
        $this->beConstructedWith($provinceViewFactory, CountryView::class);
    }

    function it_is_country_view_factory(): void
    {
        $this->shouldImplement(CountryViewFactoryInterface::class);
    }

    function it_creates_country_view(
        CountryInterface $country,
        ProvinceInterface $province,
        ProvinceViewFactoryInterface $provinceViewFactory
    ): void {
        $country->getCode()->willReturn('US');
        $country->getProvinces()->willReturn(new ArrayCollection([$province->getWrappedObject()]));
        $country->isEnabled()->willReturn(true);

        $provinceViewFactory->create($province)->willReturn(new ProvinceView());

        $countryView = new CountryView();
        $countryView->code = 'US';
        $countryView->enabled = true;
        $countryView->provinces = [new ProvinceView()];

        $this->create($country)->shouldBeLike($countryView);
    }
}
