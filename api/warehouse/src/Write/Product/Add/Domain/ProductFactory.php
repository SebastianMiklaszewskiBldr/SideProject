<?php

namespace App\Write\Product\Add\Domain;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Write\Product\Shared\Domain\Entity\Product;

final readonly class ProductFactory
{
    public function create(
        ProductId $productId,
        ProductName $productName,
        ProductCategory $productCategory,
        Amount $amount,
    ): Product
    {
        return new Product($productId, $productName, $productCategory, $amount);
    }
}
