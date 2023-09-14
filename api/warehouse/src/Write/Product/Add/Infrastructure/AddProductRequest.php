<?php

namespace App\Write\Product\Add\Infrastructure;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class AddProductRequest
{
    #[Assert\Valid]
    public ProductId $productId;

    #[Assert\Valid]
    public ProductName $productName;

    #[Assert\Valid]
    public ProductCategory $productCategory;

    #[Assert\Valid]
    public Amount $amount;

    public function __construct(
        ProductId $productId,
        ProductName $productName,
        ProductCategory $productCategory,
        Amount $amount,
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productCategory = $productCategory;
        $this->amount = $amount;
    }
}
