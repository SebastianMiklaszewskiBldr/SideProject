<?php

namespace App\Read\Product\ShowOne\Application;

use App\Shared\Domain\ValueObject\ProductId;

final readonly class ShowOneProductQuery
{
    public function __construct(public ProductId $productId)
    {
    }
}
