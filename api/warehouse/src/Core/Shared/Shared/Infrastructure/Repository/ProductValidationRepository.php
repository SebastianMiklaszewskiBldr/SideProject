<?php

namespace App\Core\Shared\Shared\Infrastructure\Repository;

use App\Core\Shared\Application\Repository\ProductValidationRepositoryInterface;
use App\Core\Shared\Domain\Entity\Product;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use LogicException;

final readonly class ProductValidationRepository implements ProductValidationRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function hasStockAProductWithProvidedName(StockId $stockId, ProductName $productName): bool
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select($qb->expr()->count('product'))
            ->from(Product::class, 'product')
            ->andWhere(
                $qb->expr()->andX(
                    $qb->expr()->eq('product.stock', ':stockId'),
                    $qb->expr()->eq('product.name', ':name')
                )
            )
            ->setParameters(
                [
                    'stockId' => $stockId->uuid,
                    'name' => $productName->name,
                ]
            )
            ->setMaxResults(1);

        try {
            return 0 !== (int) $qb->getQuery()->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            throw new LogicException($e->getMessage());
        }
    }
}
