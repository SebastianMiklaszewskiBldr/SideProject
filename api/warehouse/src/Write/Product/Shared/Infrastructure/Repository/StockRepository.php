<?php

namespace App\Write\Product\Shared\Infrastructure\Repository;

use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Domain\ValueObject\StockId;
use App\Write\Product\Shared\Application\Repository\StockRepositoryInterface;
use App\Write\Product\Shared\Domain\Entity\Stock;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\TransactionRequiredException;
use RuntimeException;

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

        if(null === $stock) {
            throw new NotFoundException(sprintf('Stock: %s not found.', $stockId->uuid));
        }

        return $stock;
    }
}