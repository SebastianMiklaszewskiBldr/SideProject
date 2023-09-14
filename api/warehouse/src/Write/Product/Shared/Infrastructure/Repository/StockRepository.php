<?php

namespace App\Write\Product\Shared\Infrastructure\Repository;

use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Domain\ValueObject\StockId;
use App\Write\Product\Shared\Application\Repository\StockRepositoryInterface;
use App\Write\Product\Shared\Domain\Entity\Stock;
use App\Write\Product\Shared\Infrastructure\Doctrine\WriteEntityManagerInterface;
use Closure;

final readonly class StockRepository implements StockRepositoryInterface
{
    public function __construct(private WriteEntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function getOneById(StockId $stockId): Stock
    {
        /** @var Stock|null $stock */
        $stock = $this->entityManager->find(Stock::class, $stockId->uuid);

        if(null === $stock) {
            throw new NotFoundException(sprintf('Stock: %s not found.', $stockId->uuid));
        }

        return $stock;
    }

    public function wrapInTransaction(Closure $transactional): void
    {
        $this->entityManager->wrapInTransaction($transactional);
    }
}
