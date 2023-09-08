<?php

namespace App\Shared\Domain\ValueObject;

final readonly class ProductCategory
{
    public function __construct(public string $category)
    {
    }
}
