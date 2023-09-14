<?php

namespace App\Tests\Read\Product\ShowOne;

use App\Read\Product\Shared\Infrastructure\ReadModel\ProductOverview;
use App\Read\Product\ShowOne\Application\ShowOneProductQuery;
use App\Read\Product\ShowOne\Application\SingleProductView;
use App\Read\Shared\Infrastructure\Doctrine\ReadEntityManagerInterface;
use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Shared\Domain\ValueObject\StockName;

final readonly class ShowOneProductTestData
{
    public function __construct(private ReadEntityManagerInterface $entityManager)
    {
    }

    public function loadData(): void
    {
        $productOverview = new ProductOverview(
            $this->getProductId(),
            $this->getProductName(),
            $this->getAmount(),
            $this->getStockId(),
            $this->getStockName()
        );

        $this->entityManager->persist($productOverview);
        $this->entityManager->flush();

    }

    public function getProductId(): ProductId
    {
        return new ProductId('8A6E8756-E6D1-4B46-82D5-0EC95076FFEC');
    }

    private function getProductName(): ProductName
    {
        return new ProductName('test product');
    }

    private function getAmount(): Amount
    {
        return new Amount(1);
    }

    private function getStockId(): StockId
    {
        return new StockId('795D2F13-CAEF-4EAC-A973-1E675B85F7A3');
    }

    private function getStockName(): StockName
    {
        return new StockName('test stock');
    }

    public function getQuery(): ShowOneProductQuery
    {
        return new ShowOneProductQuery($this->getProductId());
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
}
