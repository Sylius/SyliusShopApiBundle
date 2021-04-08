<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Controller\Country;

use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use Sylius\ShopApiPlugin\ViewRepository\Country\CountryViewRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ShowCountriesAction
{
    /** @var ViewHandlerInterface */
    private $viewHandler;

    /** @var CountryViewRepositoryInterface */
    private $countryViewRepository;

    public function __construct(
        ViewHandlerInterface $viewHandler,
        CountryViewRepositoryInterface $countryViewRepository
    ) {
        $this->countryViewRepository = $countryViewRepository;
        $this->viewHandler = $viewHandler;
    }

    public function __invoke(Request $request): Response
    {
        $countries = $this->countryViewRepository->getAllCountries();

        return $this->viewHandler->handle(View::create($countries, Response::HTTP_OK));
    }
}
