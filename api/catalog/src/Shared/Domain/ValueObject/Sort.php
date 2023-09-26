<?php

namespace App\Shared\Domain\ValueObject;

final readonly class Sort
{
    public function __construct(public SortByInterface $sortBy, public SortOrder $sortOrder)
    {
    }
}
