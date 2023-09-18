<?php

namespace App\Tests\DataBuilder;

use App\Core\AddProduct\Domain\CannotAddProductToStockException;
use App\Core\AddProduct\Domain\ProductFactory;
use App\Core\Shared\Domain\Entity\Stock;
use App\Core\Shared\Domain\Validator\ProductValidator;
use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductCategory;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;
use App\Core\Shared\Domain\ValueObject\StockName;
use App\Tests\Stub\EventStoreStub;
use LogicException;

final class TestStockBuilder
{
    private ?Stock $stock;

    public function __construct(
        private readonly ProductValidator $productValidator,
        private readonly ProductFactory $productFactory,
        private readonly EventStoreStub $eventStoreStub,
    ) {
        $this->stock = null;
    }

    public function init(StockId $stockId, StockName $stockName): self
    {
        $this->stock = new Stock($stockId, $stockName);

        return $this;
    }

    public function addProduct(
        ProductId $productId,
        ProductName $productName,
        ProductCategory $productCategory,
        Amount $amount,
    ): self {
        if (null === $this->stock) {
            throw new LogicException(
                'You cannot add product to Stock without previous Stock initialization. Call init() method.'
            );
        }

        try {
            $this->stock->addProduct(
                $productId,
                $productName,
                $productCategory,
                $amount,
                $this->productValidator,
                $this->productFactory,
                $this->eventStoreStub
            );
        } catch (CannotAddProductToStockException $e) {
            throw new LogicException($e->getMessage());
        }

        return $this;
    }

    public function build(): Stock
    {
        if (null === $this->stock) {
            throw new LogicException(
                'You cannot build Stock without previous Stock initialization. Call init() method.'
            );
        }

        $stock = $this->stock;

        $this->stock = null;

        return $stock;
    }
}
