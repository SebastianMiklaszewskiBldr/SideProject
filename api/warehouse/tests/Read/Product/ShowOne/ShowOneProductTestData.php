<?php

namespace App\Tests\Read\Product\ShowOne;

use App\Read\Product\ShowOne\Application\ShowOneProductQuery;
use App\Read\Product\ShowOne\Application\SingleProductView;
use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockName;

final readonly class ShowOneProductTestData
{
    public function getQuery(): ShowOneProductQuery
    {
        return new ShowOneProductQuery($this->getProductId());
    }

    public function getProductId(): ProductId
    {
        return new ProductId('8A6E8756-E6D1-4B46-82D5-0EC95076FFEC');
    }

    public function getExpectedProductView(): SingleProductView
    {
        return new SingleProductView(
            $this->getProductId()->uuid,
            $this->getProductName()->name,
            $this->getStockName()->name,
            $this->getAmount()->amount
        );
    }

    private function getProductName(): ProductName
    {
        return new ProductName('test product');
    }

    private function getStockName(): StockName
    {
        return new StockName('test stock');
    }

    private function getAmount(): Amount
    {
        return new Amount(1);
    }
}
