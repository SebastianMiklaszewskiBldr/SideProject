<?php

namespace App\Core\Shared\Domain\Validator;

use App\Core\Shared\Application\Repository\ProductValidationRepositoryInterface;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;

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
