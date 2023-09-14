<?php

namespace App\Read\Product\ShowOne\Application;

use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Domain\ValueObject\ProductId;

interface SingleProductProviderInterface
{
    /**
     * @throws NotFoundException
     */
    public function provide(ProductId $productId): SingleProductView;
}
