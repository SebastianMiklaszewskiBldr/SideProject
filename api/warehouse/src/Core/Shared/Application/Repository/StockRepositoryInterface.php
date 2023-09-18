<?php

namespace App\Core\Shared\Application\Repository;

use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\Shared\Domain\Entity\Stock;
use App\Core\Shared\Domain\ValueObject\StockId;
use Closure;

interface StockRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function getOneById(StockId $stockId): Stock;

    public function wrapInTransaction(Closure $transactional): void;
}
