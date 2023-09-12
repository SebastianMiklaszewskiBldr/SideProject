<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\Tests\Write\Product\Add;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Shared\Domain\ValueObject\StockName;
use App\Write\Product\Add\Application\AddProductCommand;
use App\Write\Product\Shared\Domain\Entity\Stock;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AddProductTestData
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function loadStock(): void
    {
        $stock = new Stock($this->getStockId(), new StockName('test'));

        $this->entityManager->persist($stock);
        $this->entityManager->flush();
    }

    public function getStockId(): StockId
    {
        return new StockId('5221FE61-F3AF-4FF7-B173-482E299EBC37');
    }

    /**
     * @return array<string, string|int>
     */
    public function getRequestBody(): array
    {
        return [
            'id' => $this->getProductId()->uuid,
            'name' => $this->getProductName()->name,
            'category' => $this->getCategory()->category,
            'amount' => $this->getAmount()->amount,
        ];
    }

    private function getProductId(): ProductId
    {
        return new ProductId('3260BFA7-DD48-41FE-8A7D-0A518822A8E7');
    }

    private function getProductName(): ProductName
    {
        return new ProductName('TV Rubin 12xABC');
    }

    private function getCategory(): ProductCategory
    {
        return new ProductCategory('RTV');
    }

    private function getAmount(): Amount
    {
        return new Amount(1);
    }

    public function getCommand(): AddProductCommand
    {
        return new AddProductCommand(
            $this->getStockId(),
            $this->getProductId(),
            $this->getProductName(),
            $this->getCategory(),
            $this->getAmount()
        );
    }
}
