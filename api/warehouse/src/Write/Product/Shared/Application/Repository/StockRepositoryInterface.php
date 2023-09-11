<?php

namespace App\Write\Product\Shared\Application\Repository;

use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Domain\ValueObject\StockId;
use App\Write\Product\Shared\Domain\Entity\Stock;

interface StockRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function getOneById(StockId $stockId): Stock;
}
