<?php

namespace App\Read\ListProducts\Application;

use App\Shared\Domain\ValueObject\SortByInterface;

enum ProductsListSortBy: string implements SortByInterface
{
    case NAME = 'name';

    public function getSortBy(): string
    {
        return $this->name;
    }
}
