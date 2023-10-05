<?php

namespace App\Tests\Shared\Infrastructure\Client;

use App\Shared\Application\Client\UrlFactoryInterface;
use App\Shared\Infrastructure\Client\BaseUrl;
use App\Shared\Infrastructure\Client\GuzzleAvailabilityModuleClient;
use App\Shared\Infrastructure\Client\GuzzleHttpClient;
use App\Tests\IntegrationTestCase;
use App\Tests\TestHttpStatusCode;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

final class GuzzleAvailabilityModuleClientTest extends IntegrationTestCase
{
    private GuzzleAvailabilityModuleClientTestData $testData;

    public function test_GetSortedPageOfAvailableProducts_ShouldReturnJson_WhenRequestIsNotEmpty(): void
    {
        $mockedClient = $this->mockGuzzleResponses([
            new Response(
                status: TestHttpStatusCode::SUCCESSFUL->value,
                headers: [],
                body: $this->testData->getExpectedNonEmptyJson()
            ),
        ]);
        $client = $this->getClient($mockedClient);

        $response = $client->getSortedPageOfAvailableProducts(
            $this->testData->getStockId(),
            $this->testData->getSort(),
            $this->testData->getPaginator()
        );

        self::assertEquals($this->testData->getExpectedNonEmptyJson(), $response);
    }

    public function test_GetSortedPageOfAvailableProducts_ShouldReturnEmptyJson_WhenRequestIsEmpty(): void
    {
        $mockedClient = $this->mockGuzzleResponses([
            new Response(
                status: TestHttpStatusCode::SUCCESSFUL->value,
                headers: [],
                body: $this->testData->getExpectedEmptyJson()
            ),
        ]);
        $client = $this->getClient($mockedClient);

        $response = $client->getSortedPageOfAvailableProducts(
            $this->testData->getStockId(),
            $this->testData->getSort(),
            $this->testData->getPaginator()
        );

        self::assertEquals($this->testData->getExpectedEmptyJson(), $response);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new GuzzleAvailabilityModuleClientTestData();
    }

    private function getClient(Client $client): GuzzleAvailabilityModuleClient
    {
        return new GuzzleAvailabilityModuleClient(
            new GuzzleHttpClient($client),
            $this->container->get(UrlFactoryInterface::class),
            new BaseUrl('http://localhost')
        );
    }
}
