<?php

namespace App\Shared\Domain\ValueObject;

final readonly class Paginator
{
    public function __construct(public Offset $offset, public Limit $limit)
    {
    }
}
