<?php

namespace App\Shared\Domain\ValueObject;

enum SortOrder: string
{
    case ASC = 'ASC';
    case DESC = 'DESC';
}
