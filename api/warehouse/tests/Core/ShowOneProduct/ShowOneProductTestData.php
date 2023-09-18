<?php

namespace App\Tests\Core\ShowOneProduct;

use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductCategory;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;
use App\Core\Shared\Domain\ValueObject\StockName;
use App\Core\ShowOneProduct\Application\ShowOneProductQuery;
use App\Core\ShowOneProduct\Application\SingleProductView;
use App\Tests\DataBuilder\TestStockBuilder;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ShowOneProductTestData
{
    public function __construct(private EntityManagerInterface $entityManager, private TestStockBuilder $stockBuilder)
    {
    }

    public function loadData(): void
    {
        $stock = $this->stockBuilder
            ->init($this->getStockId(), $this->getStockName())
            ->addProduct(
                $this->getProductId(),
                $this->getProductName(),
                $this->getProductCategory(),
                $this->getAmount()
            )
            ->build();

        $this->entityManager->persist($stock);
        $this->entityManager->flush();
    }

    public function getProductId(): ProductId
    {
        return new ProductId('8A6E8756-E6D1-4B46-82D5-0EC95076FFEC');
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

    private function getProductCategory(): ProductCategory
    {
        return new ProductCategory('test category');
    }
}
