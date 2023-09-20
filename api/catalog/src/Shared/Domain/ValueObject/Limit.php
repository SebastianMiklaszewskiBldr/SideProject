<?php

namespace App\Shared\Domain\ValueObject;

final readonly class Limit
{
    public function __construct(public int $limit)
    {
    }
}
