<?php

namespace App\Tests\Read\ListProducts;

use App\Read\ListProducts\Application\ProductsListSortBy;
use App\Read\ListProducts\Presentation\ListProductsRequest;
use App\Shared\Domain\ValueObject\Limit;
use App\Shared\Domain\ValueObject\Offset;
use App\Shared\Domain\ValueObject\SortOrder;
use App\Shared\Domain\ValueObject\StockId;

final readonly class ListProductsTestData
{
    public function getRequestParams(): array
    {
        return [
            'stockId' => $this->getStockId()->uuid,
            ListProductsRequest::SORT_ORDER_PROPERTY => $this->getSortOrder()->value,
            ListProductsRequest::SORT_BY_PROPERTY => $this->getSortBy()->value,
            ListProductsRequest::PAGINATION_OFFSET_PROPERTY => $this->getOffset()->offset,
            ListProductsRequest::PAGINATION_LIMIT_PROPERTY => $this->getLimit()->limit,
        ];
    }

    private function getStockId(): StockId
    {
        return new StockId('685E0949-B4B0-47AA-80CD-3D56074314BC');
    }

    private function getSortOrder(): SortOrder
    {
        return SortOrder::ASC;
    }

    private function getSortBy(): ProductsListSortBy
    {
        return ProductsListSortBy::NAME;
    }

    private function getOffset(): Offset
    {
        return new Offset(0);
    }

    private function getLimit(): Limit
    {
        return new Limit(10);
    }
}
