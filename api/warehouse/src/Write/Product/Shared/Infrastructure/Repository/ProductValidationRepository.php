<?php

namespace App\Write\Product\Shared\Infrastructure\Repository;

use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Write\Product\Shared\Application\Repository\ProductValidationRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ProductValidationRepository implements ProductValidationRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function hasStockAProductWithProvidedName(StockId $stockId, ProductName $productName): bool
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select('product')
            ->andWhere(
                $qb->expr()->andX(
                    $qb->expr()->eq('stock', ':stockId'),
                    $qb->expr()->eq('name', ':name')
                )
            )
            ->setParameters(
                [
                    'stockId' => $stockId->uuid,
                    'name' => $productName->name,
                ]
            )
            ->setMaxResults(1);

        return null !== $qb->getQuery()->getResult();
    }
}
