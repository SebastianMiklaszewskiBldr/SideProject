<?php

namespace App\Read\Product\ShowOne\Application;

use App\Shared\Application\Exception\NotFoundException;

final readonly class ShowOneProductHandler
{
    public function __construct(private SingleProductProviderInterface $productProvider)
    {
    }

    /**
     * @throws NotFoundException
     */
    public function handle(ShowOneProductQuery $query): SingleProductView
    {
        return $this->productProvider->provide($query->productId);
    }
}
