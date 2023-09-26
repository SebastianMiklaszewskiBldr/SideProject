<?php

namespace App\Read\ListProducts\Application;

use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\StockId;

final readonly class ListProductsQuery
{
    public function __construct(public StockId $stockId, public Sort $sort, public Paginator $paginator)
    {
    }
}
