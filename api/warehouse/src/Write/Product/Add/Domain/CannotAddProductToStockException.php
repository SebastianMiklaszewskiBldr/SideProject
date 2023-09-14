<?php

namespace App\Write\Product\Add\Domain;

use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use Exception;

final class CannotAddProductToStockException extends Exception
{
    public static function becauseStockAlreadyHasProduct(StockId $stockId, ProductName $productName): self
    {
        return new self(
            sprintf(
                'Product: %s cannot be added to stock %s. Stock already has the product.',
                $productName->name,
                $stockId->uuid
            )
        );
    }
}
