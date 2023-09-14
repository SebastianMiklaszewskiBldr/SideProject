<?php

namespace App\Read\Product\Shared\Infrastructure\Repository;

use App\Read\Product\Shared\Application\Repository\ProductOverviewRepositoryInterface;
use App\Read\Product\Shared\Infrastructure\ReadModel\ProductOverview;
use App\Read\Shared\Infrastructure\Doctrine\ReadEntityManagerInterface;
use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Domain\ValueObject\ProductId;

final readonly class ProductOverviewRepository implements ProductOverviewRepositoryInterface
{
    public function __construct(private ReadEntityManagerInterface $entityManager)
    {
    }

    /**
     * @inheritDoc
     */
    public function getById(ProductId $productId): ProductOverview
    {
        $product = $this->entityManager->find(ProductOverview::class, $productId->uuid);

        if(null === $product) {
            throw new NotFoundException(sprintf('Product: %s not found.', $productId->uuid));
        }

        return $product;
    }
}
