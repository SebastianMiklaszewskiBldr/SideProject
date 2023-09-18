<?php

namespace App\Core\ShowOneProduct\Infrastructure;

use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\Shared\Domain\Entity\Product;
use App\Core\Shared\Domain\ValueObject\ProductId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use LogicException;

final readonly class SingleProductRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @throws NotFoundException
     */
    public function getDataById(ProductId $productId): SingleProductDataWrapper
    {
        $qb = $this->entityManager->createQueryBuilder();

        $qb->select([
            sprintf('product.id AS %s', SingleProductDataWrapper::ID_FIELD),
            sprintf('product.name AS %s', SingleProductDataWrapper::NAME_FIELD),
            sprintf('product.amount AS %s', SingleProductDataWrapper::AMOUNT_FIELD),
            sprintf('productStock.name AS %s', SingleProductDataWrapper::STOCK_NAME_FIELD),
        ])
            ->from(Product::class, 'product')
            ->innerJoin('product.stock', 'productStock')
            ->andWhere($qb->expr()->eq('product.id', ':id'))
            ->setParameter('id', $productId->uuid);

        try {
            return new SingleProductDataWrapper($qb->getQuery()->getSingleResult());
        } catch (NoResultException $e) {
            throw new NotFoundException($e->getMessage());
        } catch (NonUniqueResultException $e) {
            throw new LogicException($e->getMessage());
        }
    }
}
