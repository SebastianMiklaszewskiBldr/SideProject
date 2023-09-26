<?php

namespace App\Tests\Read\ListProducts;

use App\Read\ListProducts\Application\AvailableProductView;
use App\Read\ListProducts\Application\ListProductsQuery;
use App\Read\ListProducts\Application\ProductsListSortBy;
use App\Read\ListProducts\Domain\AvailableProduct;
use App\Read\ListProducts\Presentation\ListProductsRequest;
use App\Shared\Domain\ValueObject\Limit;
use App\Shared\Domain\ValueObject\Offset;
use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\Quantity;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\SortOrder;
use App\Shared\Domain\ValueObject\StockId;

final readonly class ListProductsTestData
{
    public function getQuery(): ListProductsQuery
    {
        return new ListProductsQuery(
            $this->getStockId(),
            $this->getSort(),
            $this->getPaginator()
        );
    }

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

    /**
     * @return array<int, AvailableProduct>
     */
    public function getArrayOfAvailableProducts(): array
    {
        return [
            new AvailableProduct(
                $this->getProductOneId(),
                $this->getProductOneName(),
                $this->getProductOneQuantity()
            ),
            new AvailableProduct(
                $this->getProductTwoId(),
                $this->getProductTwoName(),
                $this->getProductTwoQuantity()
            ),
            new AvailableProduct(
                $this->getProductThreeId(),
                $this->getProductThreeName(),
                $this->getProductThreeQuantity()
            ),
        ];
    }

    /**
     * @return array<int, AvailableProductView>
     */
    public function getArrayOfAvailableProductViews(): array
    {
        return [
            new AvailableProductView(
                $this->getProductOneId()->uuid,
                $this->getProductOneName()->name,
                $this->getProductOneQuantity()->quantity
            ),
            new AvailableProductView(
                $this->getProductTwoId()->uuid,
                $this->getProductTwoName()->name,
                $this->getProductTwoQuantity()->quantity
            ),
            new AvailableProductView(
                $this->getProductThreeId()->uuid,
                $this->getProductThreeName()->name,
                $this->getProductThreeQuantity()->quantity
            ),
        ];
    }

    /**
     * @return array<int, AvailableProductView>
     */
    public function getEmptyArrayOfAvailableProducts(): array
    {
        return [];
    }

    /**
     * @return array<int, AvailableProductView>
     */
    public function getEmptyArrayOfAvailableProductViews(): array
    {
        return [];
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

    private function getPaginator(): Paginator
    {
        return new Paginator($this->getOffset(), $this->getLimit());
    }

    private function getSort(): Sort
    {
        return new Sort($this->getSortBy(), $this->getSortOrder());
    }

    private function getProductOneId(): ProductId
    {
        return new ProductId('D4C1F8D5-A165-4AD9-A1EB-23F25AC3DC5D');
    }

    private function getProductOneName(): ProductName
    {
        return new ProductName('product 1');
    }

    private function getProductOneQuantity(): Quantity
    {
        return new Quantity(1);
    }

    private function getProductTwoId(): ProductId
    {
        return new ProductId('5C0AE589-84CC-4F7F-8003-ABAFDA4D9CED');
    }

    private function getProductTwoName(): ProductName
    {
        return new ProductName('product 2');
    }

    private function getProductTwoQuantity(): Quantity
    {
        return new Quantity(2);
    }

    private function getProductThreeId(): ProductId
    {
        return new ProductId('FABCEA87-3ACD-4063-BA73-451EF1707858');
    }

    private function getProductThreeName(): ProductName
    {
        return new ProductName('product 3');
    }

    private function getProductThreeQuantity(): Quantity
    {
        return new Quantity(3);
    }
}
