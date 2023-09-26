<?php

namespace App\Read\ListProducts\Presentation;

use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use Symfony\Component\Validator\Constraints as Assert;

final readonly class ListProductsRequest
{
    public const SORT_BY_PROPERTY = 'sortBy';

    public const SORT_ORDER_PROPERTY = 'sortOrder';

    public const PAGINATION_OFFSET_PROPERTY = 'offset';

    public const PAGINATION_LIMIT_PROPERTY = 'limit';

    public Sort $sort;

    #[Assert\Valid]
    #[Assert\GreaterThanOrEqual(value: 0, propertyPath: 'paginator.offset.offset')]
    #[Assert\GreaterThanOrEqual(value: 1, propertyPath: 'paginator.limit.limit')]
    public Paginator $paginator;

    public function __construct(Sort $sort, Paginator $paginator)
    {
        $this->sort = $sort;
        $this->paginator = $paginator;
    }
}
