<?php

namespace App\Write\Product\Shared\Application\Validator;

use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Write\Product\Shared\Application\Repository\ProductValidationRepositoryInterface;

final readonly class ProductValidator
{
    public function __construct(private ProductValidationRepositoryInterface $productValidationRepository)
    {
    }

    public function hasStockAlreadyProduct(StockId $stockId, ProductName $productName): bool
    {
        if (true === $this->productValidationRepository->hasStockAProductWithProvidedName($stockId, $productName)) {
            return true;
        }

        return false;
    }
}
