<?php

namespace App\Core\AddProduct\Infrastructure;

use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductCategory;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
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
