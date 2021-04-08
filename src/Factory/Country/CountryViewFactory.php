<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Factory\Country;

use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Addressing\Model\ProvinceInterface;
use Sylius\ShopApiPlugin\View\Country\CountryView;

final class CountryViewFactory implements CountryViewFactoryInterface
{
    /** @var ProvinceViewFactoryInterface */
    private $provinceViewFactory;

    /** @var string */
    private $countryViewClass;

    public function __construct(ProvinceViewFactoryInterface $provinceViewFactory, string $countryViewClass)
    {
        $this->provinceViewFactory = $provinceViewFactory;
        $this->countryViewClass = $countryViewClass;
    }

    public function create(CountryInterface $country): CountryView
    {
        /** @var CountryView $countryView */
        $countryView = new $this->countryViewClass();

        $countryView->code = $country->getCode();
        $countryView->enabled = $country->isEnabled();

        /** @var ProvinceInterface $province */
        foreach ($country->getProvinces() as $province) {
            $countryView->provinces[] = $this->provinceViewFactory->create($province);
        }

        return $countryView;
    }
}
