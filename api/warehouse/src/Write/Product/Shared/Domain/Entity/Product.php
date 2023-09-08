<?php

namespace App\Write\Product\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;

final readonly class Product
{
    private string $productId;
    private string $productName;
    private string $productCategory;
    private int $amount;

    public function __construct(
        ProductId $productId,
        ProductName $productName,
        ProductCategory $productCategory,
        Amount $amount,
    )
    {
        $this->productId = $productId->uuid;
        $this->productName = $productName->name;
        $this->productCategory = $productCategory->category;
        $this->amount = $amount->amount;
    }
}
