<?php

namespace App\Read\ListProducts\Presentation;

use App\Read\ListProducts\Application\ProductsListSortBy;
use App\Shared\Domain\ValueObject\Limit;
use App\Shared\Domain\ValueObject\Offset;
use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\SortOrder;
use App\Shared\Infrastructure\Validator\SymfonyValidatorWrapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final readonly class ListProductsRequestMapper
{
    public function __construct(private SymfonyValidatorWrapper $validator)
    {
    }

    public function map(Request $request): ListProductsRequest
    {
        $sort = $this->getSort($request);
        $paginator = $this->getPaginator($request);

        $mappedRequest = new ListProductsRequest($sort, $paginator);

        $violations = $this->validator->validate($mappedRequest);

        if (0 !== $violations->count()) {
            $this->throwException($violations);
        }

        return $mappedRequest;
    }

    private function throwException(ConstraintViolationListInterface $violations): void
    {
        throw new BadRequestHttpException($violations->get(0));
    }

    private function getSort(Request $request): Sort
    {
        $sortBy = ProductsListSortBy::tryFrom($request->query->get(ListProductsRequest::SORT_BY_PROPERTY));
        $sortOrder = SortOrder::tryFrom($request->query->get(ListProductsRequest::SORT_ORDER_PROPERTY));

        if (null === $sortBy || null === $sortOrder) {
            throw new BadRequestHttpException(
                sprintf(
                    'Invalid sort value. Available sort values [sortOrder => ASC|DESC, sortBy => %s',
                    implode(
                        '|',
                        array_map(
                            static fn(ProductsListSortBy $case): string => $case->value,
                            ProductsListSortBy::cases()
                        )
                    )
                )
            );
        }

        return new Sort($sortBy, $sortOrder);
    }

    private function getPaginator(Request $request): Paginator
    {
        return new Paginator(
            new Offset($request->query->get('offset')),
            new Limit($request->query->get('limit'))
        );
    }
}
