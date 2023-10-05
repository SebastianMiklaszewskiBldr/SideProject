<?php

namespace App\Read\ListProducts\Infrastructure;

use App\Read\ListProducts\Domain\AvailableProduct;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\Quantity;

final readonly class AvailableProductsResponseMapper
{
    /**
     * @return array<AvailableProduct>
     */
    public function map(string $responseJson): array
    {
        $responseArray = json_decode(json: $responseJson, associative: true);

        return array_map(static fn(array $productData): AvailableProduct => new AvailableProduct(
            new ProductId($productData['id']),
            new ProductName($productData['name']),
            new Quantity($productData['quantity'])
        ), $responseArray);
    }
}
