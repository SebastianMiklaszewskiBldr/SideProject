<?php

namespace App\Core\AddProduct\Application;

use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductCategory;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;

final readonly class AddProductCommand
{
    public function __construct(
        public StockId $stockId,
        public ProductId $productId,
        public ProductName $productName,
        public ProductCategory $productCategory,
        public Amount $amount,
    ) {
    }
}
