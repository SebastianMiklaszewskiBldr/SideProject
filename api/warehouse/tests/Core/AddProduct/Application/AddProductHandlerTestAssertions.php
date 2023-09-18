<?php

namespace App\Tests\Core\AddProduct\Application;

use App\Core\Shared\Domain\Entity\Product;
use App\Core\Shared\Domain\ValueObject\ProductId;
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
