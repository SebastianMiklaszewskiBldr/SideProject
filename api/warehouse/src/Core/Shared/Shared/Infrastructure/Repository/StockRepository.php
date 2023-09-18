<?php

namespace App\Core\Shared\Shared\Infrastructure\Repository;

use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\Shared\Application\Repository\StockRepositoryInterface;
use App\Core\Shared\Domain\Entity\Stock;
use App\Core\Shared\Domain\ValueObject\StockId;
use Closure;
use Doctrine\ORM\EntityManagerInterface;

final readonly class StockRepository implements StockRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function getOneById(StockId $stockId): Stock
    {
        /** @var Stock|null $stock */
        $stock = $this->entityManager->find(Stock::class, $stockId->uuid);

        if (null === $stock) {
            throw new NotFoundException(sprintf('Stock: %s not found.', $stockId->uuid));
        }

        return $stock;
    }

    public function wrapInTransaction(Closure $transactional): void
    {
        $this->entityManager->wrapInTransaction($transactional);
    }
}
