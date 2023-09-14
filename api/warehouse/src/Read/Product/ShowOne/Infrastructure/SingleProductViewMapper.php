<?php

namespace App\Read\Product\ShowOne\Infrastructure;

use App\Read\Product\Shared\Infrastructure\ReadModel\ProductOverview;
use App\Read\Product\ShowOne\Application\SingleProductView;

final readonly class SingleProductViewMapper
{
    public function map(ProductOverview $product): SingleProductView
    {
        return new SingleProductView(
            $product->getId()->uuid,
            $product->getName()->name,
            $product->getStockName()->name,
            $product->getAmount()->amount
        );
    }
}
