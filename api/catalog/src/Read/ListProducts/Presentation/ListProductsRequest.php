<?php

namespace App\Read\ListProducts\Presentation;

use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;

final readonly class ListProductsRequest
{
    public function __construct(Sort $sort, Paginator $paginator)
    {
    }
}
