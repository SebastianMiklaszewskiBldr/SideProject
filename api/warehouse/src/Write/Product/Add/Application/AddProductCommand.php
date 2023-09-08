<?php

namespace App\Write\Product\Add\Application;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;

final readonly class AddProductCommand
{
    public function __construct(
        public StockId         $stockId,
        public ProductId       $productId,
        public ProductName     $productName,
        public ProductCategory $productCategory,
        public Amount          $amount,
    )
    {
    }
}
