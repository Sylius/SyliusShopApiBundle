<?php

declare(strict_types=1);

namespace Tests\Sylius\ShopApiPlugin\Controller\Country;

use Symfony\Component\HttpFoundation\Response;
use Tests\Sylius\ShopApiPlugin\Controller\JsonApiTestCase;

final class ShowAllCountriesApiTest extends JsonApiTestCase
{
    /**
     * @test
     */
    public function it_shows_all_countries_with_provinces(): void
    {
        $this->loadFixturesFromFiles(['country.yml']);

        $this->client->request('GET', '/shop-api/countries', [], [], self::CONTENT_TYPE_HEADER);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'country/all_countries_response', Response::HTTP_OK);
    }
}
