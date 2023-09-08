<?php

namespace App\Write\Product\Add\Infrastructure;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;

final readonly class AddProductRequest
{
    public function __construct(
        public ProductId $productId,
        public ProductName $productName,
        public ProductCategory $productCategory,
        public Amount $amount,
    ) {
    }
}
