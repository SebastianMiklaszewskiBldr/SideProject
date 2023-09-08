<?php

namespace App\Write\Product\Shared\Application\Repository;

use App\Shared\Domain\ValueObject\StockId;
use App\Write\Product\Shared\Domain\Entity\Stock;

interface StockRepositoryInterface
{
    public function getOneById(StockId $stockId): Stock;
}
