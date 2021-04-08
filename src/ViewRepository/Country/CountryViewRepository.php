<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\ViewRepository\Country;

use Sylius\Component\Addressing\Model\CountryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\ShopApiPlugin\Factory\Country\CountryViewFactoryInterface;
use Sylius\ShopApiPlugin\View\Country\CountryView;

final class CountryViewRepository implements CountryViewRepositoryInterface
{
    /** @var RepositoryInterface */
    private $countryRepository;

    /** @var CountryViewFactoryInterface */
    private $countryViewFactory;

    public function __construct(
        RepositoryInterface $countryRepository,
        CountryViewFactoryInterface $countryViewFactory
    ) {
        $this->countryRepository = $countryRepository;
        $this->countryViewFactory = $countryViewFactory;
    }

    public function getAllCountries(): array
    {
        $countries = $this->countryRepository->findAll();

        $countryViews = [];

        /** @var CountryInterface $country */
        foreach ($countries as $country) {
            $countryViews[] = $this->buildCountryView($country);
        }

        return $countryViews;
    }

    private function buildCountryView(CountryInterface $country): CountryView
    {
        $countryView = $this->countryViewFactory->create($country);

        return $countryView;
    }
}
