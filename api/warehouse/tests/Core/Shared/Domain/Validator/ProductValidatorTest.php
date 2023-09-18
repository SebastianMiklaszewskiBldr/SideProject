<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\Tests\Core\Shared\Domain\Validator;

use App\Core\Shared\Application\Repository\ProductValidationRepositoryInterface;
use App\Core\Shared\Domain\Validator\ProductValidator;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;
use App\Tests\UnitTestCase;
use PHPUnit\Framework\MockObject\MockObject;

final class ProductValidatorTest extends UnitTestCase
{
    private MockObject $productValidationRepositoryMock;

    public function test_HasStockAlreadyProduct_ShouldReturnTrue_WhenInStockIsAlreadyProductWithProvidedName(): void
    {
        $this->productValidationRepositoryMock
            ->method('hasStockAProductWithProvidedName')
            ->willReturn(true);
        $validator = new ProductValidator($this->productValidationRepositoryMock);

        $result = $validator->hasStockAlreadyProduct(
            new StockId('03373948-3877-4B6C-844F-68EFAFB42623'),
            new ProductName('test')
        );

        self::assertTrue($result);
    }
    public function test_HasStockAlreadyProduct_ShouldReturnFalse_WhenStockDoesNotHaveAlreadyProductWithProvidedName(): void
    {
        $this->productValidationRepositoryMock
            ->method('hasStockAProductWithProvidedName')
            ->willReturn(false);
        $validator = new ProductValidator($this->productValidationRepositoryMock);

        $result = $validator->hasStockAlreadyProduct(
            new StockId('03373948-3877-4B6C-844F-68EFAFB42623'),
            new ProductName('test')
        );

        self::assertFalse($result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->productValidationRepositoryMock = $this->createMock(ProductValidationRepositoryInterface::class);
    }
}
