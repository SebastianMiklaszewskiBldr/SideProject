<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\Tests\Write\Product\Shared\Application\Validator;

use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Tests\UnitTestCase;
use App\Write\Product\Shared\Application\Repository\ProductValidationRepositoryInterface;
use App\Write\Product\Shared\Application\Validator\ProductValidator;
use PHPUnit\Framework\MockObject\MockObject;

final class ProductValidatorTest extends UnitTestCase
{
    private MockObject $productValidationRepositoryMock;

    public function test_ValidateProductCanBeAddedToStock_ShouldReturnFalse_WhenInStockIsAlreadyProductWithProvidedName(): void
    {
        $this->productValidationRepositoryMock
            ->method('hasStockAProductWithProvidedName')
            ->willReturn(true);
        $validator = new ProductValidator($this->productValidationRepositoryMock);

        $result = $validator->hasStockAlreadyProduct(
            new StockId('03373948-3877-4B6C-844F-68EFAFB42623'),
            new ProductName('test')
        );

        self::assertFalse($result);
    }
    public function test_ValidateProductCanBeAddedToStock_ShouldReturnTrue_WhenStockDoesNotHaveAlreadyProductWithProvidedName(): void
    {
        $this->productValidationRepositoryMock
            ->method('hasStockAProductWithProvidedName')
            ->willReturn(false);
        $validator = new ProductValidator($this->productValidationRepositoryMock);

        $result = $validator->hasStockAlreadyProduct(
            new StockId('03373948-3877-4B6C-844F-68EFAFB42623'),
            new ProductName('test')
        );

        self::assertTrue($result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->productValidationRepositoryMock = $this->createMock(ProductValidationRepositoryInterface::class);
    }
}
