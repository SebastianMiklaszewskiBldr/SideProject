<?php

namespace App\Tests\Shared\Infrastructure\Client;

use App\Read\ListProducts\Application\ProductsListSortBy;
use App\Shared\Domain\ValueObject\Limit;
use App\Shared\Domain\ValueObject\Offset;
use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\SortOrder;
use App\Shared\Domain\ValueObject\StockId;

final readonly class GuzzleAvailabilityModuleClientTestData
{
    public function getStockId(): StockId
    {
        return new StockId('EC288C2B-D265-49CF-BEF9-880D269C2789');
    }

    public function getSort(): Sort
    {
        return new Sort(ProductsListSortBy::NAME, SortOrder::ASC);
    }

    public function getPaginator(): Paginator
    {
        return new Paginator(new Offset(0), new Limit(10));
    }

    public function getExpectedNonEmptyJson(): string
    {
        return file_get_contents('./NonEmptyAvailableListOfProductsJson.json');
    }

    public function getExpectedEmptyJson(): string
    {
        return '';
    }
}
