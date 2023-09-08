<?php

namespace App\Tests\Write\Product\Add\Domain;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Shared\Domain\ValueObject\StockName;
use App\Tests\UnitTestCase;
use App\Write\Product\Add\Domain\CannotAddProductToStockException;
use App\Write\Product\Add\Domain\ProductFactory;
use App\Write\Product\Shared\Application\Repository\ProductValidationRepositoryInterface;
use App\Write\Product\Shared\Application\Validator\ProductValidator;
use App\Write\Product\Shared\Domain\Entity\Stock;

final class AddProductTest extends UnitTestCase
{
    private Stock $stock;
    private ProductFactory $productFactory;

    public function test_AddProduct_ShouldThrowException_WhenStockAlreadyHasProductWithProvidedName(): void
    {
        $productValidationRepositoryMock = $this->createMock(ProductValidationRepositoryInterface::class);
        $productValidationRepositoryMock
            ->method('hasStockAProductWithProvidedName')
            ->willReturn(true);

        $productValidator = new ProductValidator($productValidationRepositoryMock);
        $this->expectException(CannotAddProductToStockException::class);
        $this->expectExceptionMessage(
            CannotAddProductToStockException::becauseStockAlreadyHasProduct(
                $this->getStockId(),
                $this->getProductName()
            )->getMessage()
        );

        $this->stock->addProduct(
            new ProductId('76FD80F6-F819-433B-AEF1-4D3D7B9E6676'),
            $this->getProductName(),
            new ProductCategory('test'),
            new Amount(1),
            $productValidator,
            $this->productFactory
        );
    }

    private function getStockId(): StockId
    {
        return new StockId('8C5DB138-623A-4974-A364-FB54E90F33D1');
    }

    private function getProductName(): ProductName
    {
        return new ProductName('test');
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->stock = new Stock($this->getStockId(), StockName::default());
        $this->productFactory = new ProductFactory();
    }
}
