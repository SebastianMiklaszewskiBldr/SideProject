<?php

namespace App\Tests\Read\ListProducts;

use App\Read\ListProducts\Application\ProductsListSortBy;
use App\Shared\Domain\ValueObject\SortOrder;
use App\Shared\Domain\ValueObject\StockId;

final readonly class ListProductsTestData
{
    public function getRequestParams(): array
    {
        return [
            'stockId' => $this->getStockId()->uuid,
            'sortOrder' => $this->getSortOrder()->name,
            'sortBy' => $this->getSortBy()->name,
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
}
