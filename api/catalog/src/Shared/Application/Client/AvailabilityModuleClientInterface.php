<?php

namespace App\Shared\Application\Client;

use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\StockId;

interface AvailabilityModuleClientInterface
{
    public function getSortedPageOfAvailableProducts(StockId $stockId, Sort $sort, Paginator $paginator): string;
}
