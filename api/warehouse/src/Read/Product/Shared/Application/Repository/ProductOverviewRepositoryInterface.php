<?php

namespace App\Read\Product\Shared\Application\Repository;

use App\Read\Product\Shared\Infrastructure\ReadModel\ProductOverview;
use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Domain\ValueObject\ProductId;

interface ProductOverviewRepositoryInterface
{
    /**
     * @throws NotFoundException
     */
    public function getById(ProductId $productId): ProductOverview;
}
