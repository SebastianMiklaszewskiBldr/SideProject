<?php

namespace App\Read\Integration\Product;

use App\Read\Product\Shared\Infrastructure\ReadModel\ProductOverview;
use App\Read\Shared\Infrastructure\Doctrine\ReadEntityManagerInterface;
use App\Shared\Domain\Event\ProductAdded;
use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Shared\Domain\ValueObject\StockName;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class IntegrateAddedProductListener
{
    public function __construct(private ReadEntityManagerInterface $entityManager)
    {
    }

    public function __invoke(ProductAdded $event): void
    {
        $productOverview = new ProductOverview(
            new ProductId($event->productId),
            new ProductName($event->productName),
            new Amount($event->amount),
            new StockId($event->stockId),
            new StockName($event->stockName)
        );

        $this->entityManager->persist($productOverview);
        $this->entityManager->flush();
    }
}
