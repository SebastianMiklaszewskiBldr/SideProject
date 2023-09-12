<?php

namespace App\Tests\Write\Product\Add\Application;

use App\Shared\Domain\ValueObject\ProductId;
use App\Write\Product\Shared\Domain\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

final readonly class AddProductHandlerTestAssertions
{
    public function __construct(private AddProductHandlerTest $testCase, private EntityManagerInterface $entityManager)
    {
    }

    public function assertProductWasSaved(ProductId $productId): void
    {
        $product = $this->entityManager->find(Product::class, $productId->uuid);

        $this->testCase::assertNotNull($product);
    }
}
