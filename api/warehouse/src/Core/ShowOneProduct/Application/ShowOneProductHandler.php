<?php

namespace App\Core\ShowOneProduct\Application;

use App\Core\Shared\Application\Exception\NotFoundException;

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
