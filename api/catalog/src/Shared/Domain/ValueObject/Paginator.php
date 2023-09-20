<?php

namespace App\Shared\Domain\ValueObject;

final readonly class Paginator
{
    public function __construct(Offset $offset, Limit $limit)
    {
    }
}
