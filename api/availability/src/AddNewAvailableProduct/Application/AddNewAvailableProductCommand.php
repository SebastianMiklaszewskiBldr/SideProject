<?php

namespace App\AddNewAvailableProduct\Application;

use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;

final readonly class AddNewAvailableProductCommand
{
    public function __construct(public StockId $stockId, public ProductId $id, public ProductName $name)
    {
    }
}
