<?php

namespace App\Read\ListProducts\Application;

use App\Read\ListProducts\Domain\AvailableProduct;

final readonly class AvailableProductViewMapper
{
    /**
     * @param array<AvailableProduct> $availableProducts
     * @return array<AvailableProductView>
     */
    public function map(array $availableProducts): array
    {
        return array_map(
            static fn(AvailableProduct $availableProduct): AvailableProductView => new
            AvailableProductView(
                $availableProduct->productId->uuid,
                $availableProduct->productName->name,
                $availableProduct->quantity->quantity
            ),
            $availableProducts
        );
    }
}
