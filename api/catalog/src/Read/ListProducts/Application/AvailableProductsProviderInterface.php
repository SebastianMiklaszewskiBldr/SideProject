<?php

namespace App\Read\ListProducts\Application;

use App\Read\ListProducts\Domain\AvailableProduct;
use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\StockId;

interface AvailableProductsProviderInterface
{

    /**
     * @return array<AvailableProduct>
     */
    public function provide(StockId $stockId, Sort $sort, Paginator $paginator): array;
}
