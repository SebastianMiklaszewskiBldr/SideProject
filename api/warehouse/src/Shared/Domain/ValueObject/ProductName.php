<?php

namespace App\Shared\Domain\ValueObject;

final readonly class ProductName
{
    public function __construct(public string $name)
    {
    }
}
