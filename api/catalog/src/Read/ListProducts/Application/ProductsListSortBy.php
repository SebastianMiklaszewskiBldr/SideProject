<?php

namespace App\Read\ListProducts\Application;

use App\Shared\Domain\ValueObject\SortByInterface;

enum ProductsListSortBy implements SortByInterface
{
    case NAME;

    public function getSortBy(): string
    {
        return $this->name;
    }
}
