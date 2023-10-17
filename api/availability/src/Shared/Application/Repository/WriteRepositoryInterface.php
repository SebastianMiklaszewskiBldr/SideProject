<?php

namespace App\Shared\Application\Repository;

use App\Shared\Application\Model\Product;

interface WriteRepositoryInterface
{
    public function save(Product $product): void;
}
