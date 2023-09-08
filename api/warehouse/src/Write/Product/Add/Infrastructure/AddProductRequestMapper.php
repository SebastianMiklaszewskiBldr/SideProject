<?php

namespace App\Write\Product\Add\Infrastructure;

use App\Shared\Domain\Exception\InvalidAmountException;
use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Write\Product\Shared\Application\Validator\UuidValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final readonly class AddProductRequestMapper
{
    public function __construct(private UuidValidatorInterface $uuidValidator)
    {
    }

    public function map(Request $request): AddProductRequest
    {
        return new AddProductRequest(
            $this->mapProductId($request->request->get('productId')),
            $this->mapProductName($request->request->get('name')),
            $this->mapProductCategory($request->request->get('category')),
            $this->mapAmount($request->request->get('amount'))
        );
    }

    private function mapProductId(float|bool|int|string|null $productId): ProductId
    {
        if(false === is_string($productId)) {
            throw new BadRequestHttpException('Request requires "productId" to be a string.');
        }

        if(0 === strlen($productId)) {
            throw new BadRequestHttpException('Request requires "productId" to be a non-empty string.');
        }

        if(false === $this->uuidValidator->validate($productId)) {
            throw new BadRequestHttpException('Request parameter "productId" has to be valid UUID v4.');
        }

        return new ProductId($productId);
    }

    private function mapProductName(float|bool|int|string|null $productName): ProductName
    {
        if(false === is_string($productName)) {
            throw new BadRequestHttpException('Request requires "productName" to be a string.');
        }

        if(0 === strlen($productName)) {
            throw new BadRequestHttpException('Request requires "productName" to be a non-empty string.');
        }

        return new ProductName($productName);
    }

    private function mapProductCategory(float|bool|int|string|null $productCategory): ProductCategory
    {
        if(false === is_string($productCategory)) {
            throw new BadRequestHttpException('Request requires "category" to be a string.');
        }

        if(0 === strlen($productCategory)) {
            throw new BadRequestHttpException('Request requires "category" to be a non-empty string.');
        }

        return new ProductCategory($productCategory);
    }

    private function mapAmount(float|bool|int|string|null $amount): Amount
    {
        if(false === is_numeric($amount)) {
            throw new BadRequestHttpException('Request requires "amount" to be a number.');
        }

        try {
            return new Amount((int) $amount);
        } catch(InvalidAmountException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}
