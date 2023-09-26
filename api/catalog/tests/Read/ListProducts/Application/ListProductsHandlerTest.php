<?php

namespace App\Tests\Read\ListProducts\Application;

use App\Read\ListProducts\Application\AvailableProductsProviderInterface;
use App\Read\ListProducts\Application\AvailableProductViewMapper;
use App\Read\ListProducts\Application\ListProductsHandler;
use App\Tests\Read\ListProducts\ListProductsTestData;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class ListProductsHandlerTest extends TestCase
{
    private ListProductsTestData $testData;
    private MockObject $availableProductsProviderMock;

    public function test_Handle_ShouldReturnArrayOfAvailableProducts_WhenProviderReturnsArrayOfAvailableProducts(): void
    {
        $this->availableProductsProviderMock
            ->method('provide')
            ->willReturn($this->testData->getArrayOfAvailableProducts());
        $handler = $this->getHandler();

        $results = $handler->handle($this->testData->getQuery());

        self::assertEquals($this->testData->getArrayOfAvailableProductViews(), $results);
    }

    public function test_Handle_ShouldReturnEmptyArray_WhenProviderDoesNotReturnAnyProduct(): void
    {
        $this->availableProductsProviderMock
            ->method('provide')
            ->willReturn($this->testData->getEmptyArrayOfAvailableProducts());
        $handler = $this->getHandler();

        $results = $handler->handle($this->testData->getQuery());

        self::assertEquals($this->testData->getEmptyArrayOfAvailableProductViews(), $results);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ListProductsTestData();
        $this->availableProductsProviderMock = $this->createMock(AvailableProductsProviderInterface::class);
    }

    private function getHandler(): ListProductsHandler
    {
        return new ListProductsHandler($this->availableProductsProviderMock, new AvailableProductViewMapper());
    }
}
