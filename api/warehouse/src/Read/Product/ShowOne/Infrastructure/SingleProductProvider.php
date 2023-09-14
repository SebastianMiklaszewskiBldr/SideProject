<?php

namespace App\Read\Product\ShowOne\Infrastructure;

use App\Read\Product\Shared\Application\Repository\ProductOverviewRepositoryInterface;
use App\Read\Product\ShowOne\Application\SingleProductProviderInterface;
use App\Read\Product\ShowOne\Application\SingleProductView;
use App\Shared\Domain\ValueObject\ProductId;

final readonly class SingleProductProvider implements SingleProductProviderInterface
{
    public function __construct(
        private ProductOverviewRepositoryInterface $productOverviewRepository,
        private SingleProductViewMapper $mapper,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function provide(ProductId $productId): SingleProductView
    {
        return $this->mapper->map($this->productOverviewRepository->getById($productId));
    }
}
