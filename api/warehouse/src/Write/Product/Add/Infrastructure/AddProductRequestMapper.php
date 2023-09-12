<?php

namespace App\Write\Product\Add\Infrastructure;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Infrastructure\Validator\SymfonyValidatorWrapper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;

final readonly class AddProductRequestMapper
{
    public function __construct(private SymfonyValidatorWrapper $validator)
    {
    }

    public function map(Request $request): AddProductRequest
    {
        $request = new AddProductRequest(
            new ProductId($request->request->get('id')),
            new ProductName($request->request->get('name')),
            new ProductCategory($request->request->get('category')),
            new Amount($request->request->get('amount'))
        );

        $violations = $this->validator->validate($request);

        if(0 !== $violations->count()) {
            $this->throwException($violations);
        }

        return $request;
    }

    private function throwException(ConstraintViolationListInterface $violations): void
    {
        throw new BadRequestHttpException($violations->get(0)->getMessage());
    }
}
