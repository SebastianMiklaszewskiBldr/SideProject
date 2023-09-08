<?php

namespace App\Write\Product\Shared\Application\Repository;

use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;

interface ProductValidationRepositoryInterface
{
    public function hasStockAProductWithProvidedName(StockId $stockId, ProductName $productName): bool;
}
