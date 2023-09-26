<?php

namespace App\Shared\Domain\ValueObject;

final readonly class Quantity
{
    public function __construct(public int $quantity)
    {
    }
}
