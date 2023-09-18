<?php

namespace App\Core\AddProduct\Domain;

use App\Core\Shared\Domain\Entity\Product;
use App\Core\Shared\Domain\Entity\Stock;
use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductCategory;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;

final readonly class ProductFactory
{
    public function create(
        ProductId $productId,
        ProductName $productName,
        ProductCategory $productCategory,
        Amount $amount,
        Stock $stock,
    ): Product {
        return new Product($productId, $productName, $productCategory, $amount, $stock);
    }
}
