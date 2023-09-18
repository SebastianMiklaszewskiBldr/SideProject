<?php

namespace App\Core\ShowOneProduct\Domain;

use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;
use App\Core\Shared\Domain\ValueObject\StockName;

final readonly class SingleProductOverview
{
    public function __construct(
        public ProductId $id,
        public ProductName $name,
        public Amount $amount,
        public StockId $stockId,
        public StockName $stockName,
    ) {
    }
}
