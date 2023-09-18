<?php

namespace App\Core\ShowOneProduct\Application;

use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\Shared\Domain\ValueObject\ProductId;

interface SingleProductProviderInterface
{
    /**
     * @throws NotFoundException
     */
    public function provide(ProductId $productId): SingleProductView;
}
