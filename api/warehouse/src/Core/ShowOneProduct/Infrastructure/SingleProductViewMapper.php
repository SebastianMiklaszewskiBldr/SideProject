<?php

namespace App\Core\ShowOneProduct\Infrastructure;

use App\Core\ShowOneProduct\Application\SingleProductView;

final readonly class SingleProductViewMapper
{
    public function map(SingleProductDataWrapper $product): SingleProductView
    {
        return new SingleProductView(
            $product->getProductId()->uuid,
            $product->getProductName()->name,
            $product->getStockName()->name,
            $product->getAmount()->amount
        );
    }
}
