<?php

namespace App\Tests\Read\ListProducts\Application;

use App\Read\ListProducts\Application\ListProductsHandler;
use App\Shared\Infrastructure\Client\GuzzleHttpClient;
use App\Tests\IntegrationTestCase;
use App\Tests\Read\ListProducts\ListProductsTestData;
use GuzzleHttp\Psr7\Response;

final class ListProductsHandlerTest extends IntegrationTestCase
{
    private ListProductsTestData $testData;

    public function test_Handle_ShouldReturnArrayOfAvailableProducts_WhenProviderReturnsArrayOfAvailableProducts(): void
    {
        $this->container->set(
            GuzzleHttpClient::class,
            new GuzzleHttpClient(
                $this->mockGuzzleResponses(
                    [new Response(200, [], $this->testData->getSerializedArrayOfAvailableProducts())]
                )
            )
        );
        $handler = $this->getHandler();

        $results = $handler->handle($this->testData->getQuery());

        self::assertEquals($this->testData->getArrayOfAvailableProductViews(), $results);
    }

    public function test_Handle_ShouldReturnEmptyArray_WhenProviderDoesNotReturnAnyProduct(): void
    {
        $this->container->set(
            GuzzleHttpClient::class,
            new GuzzleHttpClient(
                $this->mockGuzzleResponses(
                    [new Response(200, [], $this->testData->getEmptyArrayOfAvailableProducts())]
                )
            )
        );
        $handler = $this->getHandler();

        $results = $handler->handle($this->testData->getQuery());

        self::assertEquals($this->testData->getEmptyArrayOfAvailableProductViews(), $results);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ListProductsTestData();
    }

    private function getHandler(): ListProductsHandler
    {
        return $this->container->get(ListProductsHandler::class);
    }
}
