<?php

namespace App\Core\Shared\Application\Repository;

use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;

interface ProductValidationRepositoryInterface
{
    public function hasStockAProductWithProvidedName(StockId $stockId, ProductName $productName): bool;
}
