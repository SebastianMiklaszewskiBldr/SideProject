<?php

namespace App\Core\ShowOneProduct\Infrastructure;

use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\ShowOneProduct\Application\SingleProductProviderInterface;
use App\Core\ShowOneProduct\Application\SingleProductView;
use App\Read\Product\Shared\Application\Repository\ProductOverviewRepositoryInterface;

final readonly class SingleProductProvider implements SingleProductProviderInterface
{
    public function __construct(
        private SingleProductRepository $repository,
        private SingleProductViewMapper $mapper,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function provide(ProductId $productId): SingleProductView
    {
        return $this->mapper->map($this->repository->getDataById($productId));
    }
}
