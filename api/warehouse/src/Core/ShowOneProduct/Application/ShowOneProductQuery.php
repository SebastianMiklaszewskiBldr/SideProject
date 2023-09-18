<?php

namespace App\Core\ShowOneProduct\Application;

use App\Core\Shared\Domain\ValueObject\ProductId;

final readonly class ShowOneProductQuery
{
    public function __construct(public ProductId $productId)
    {
    }
}
