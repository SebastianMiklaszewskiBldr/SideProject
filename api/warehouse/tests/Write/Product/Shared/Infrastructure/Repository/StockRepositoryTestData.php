<?php

namespace App\Tests\Write\Product\Shared\Infrastructure\Repository;

use App\Shared\Domain\ValueObject\StockId;
use App\Shared\Domain\ValueObject\StockName;
use App\Write\Product\Shared\Domain\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;

final readonly class StockRepositoryTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function loadStock(StockId $stockId): void
    {
        $stock = new Stock($stockId, new StockName('test'));

        $this->entityManager->persist($stock);
        $this->entityManager->flush();
    }

    public function getStockId(): StockId
    {
        return new StockId('CD9D5AEF-1649-4294-96BB-2363E9FCD66E');
    }
}
