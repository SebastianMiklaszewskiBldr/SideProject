<?php

namespace App\Read\ListProducts\Domain;

use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\Quantity;

final readonly class AvailableProduct
{
    public function __construct(
        public ProductId $productId,
        public ProductName $productName,
        public Quantity $quantity,
    ) {
    }
}
