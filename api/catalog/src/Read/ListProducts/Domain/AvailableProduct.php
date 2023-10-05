<?php

namespace App\Read\ListProducts\Domain;

use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\Quantity;

final readonly class AvailableProduct
{
    public function __construct(
        public ProductId $id,
        public ProductName $name,
        public Quantity $quantity,
    ) {
    }
}
