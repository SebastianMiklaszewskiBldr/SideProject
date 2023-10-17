<?php

namespace App\Shared\Application\Model;

use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;

final readonly class ProductFactory
{
    public function create(ProductId $id, ProductName $name, StockId $stockId): Product
    {
        return new Product($id, $name, $stockId);
    }
}
