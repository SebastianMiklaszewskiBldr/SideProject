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
        $productId = $request->request->get('productId');
        $productName = $request->request->get('name');
        $productCategory = $request->request->get('category');
        $amount = $request->request->get('amount');

        $this->assertValues($productId, $productName, $productCategory, $amount);

        try {
            return new AddProductRequest(
                new ProductId($productId),
                new ProductName($productName),
                new ProductCategory($productCategory),
                new Amount($amount)
            );
        } catch(InvalidAmountException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    private function assertValues(
        float|bool|int|string|null $productId,
        float|bool|int|string|null $productName,
        float|bool|int|string|null $productCategory,
        float|bool|int|string|null $amount,
    ): void
    {
        $this->assertProductId($productId);
        $this->assertProductName($productName);
        $this->assertProductCategory($productCategory);
        $this->assertAmount($amount);
    }

    private function assertProductId(float|bool|int|string|null $productId): void
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
    }

    private function assertProductName(float|bool|int|string|null $productName): void
    {
        if(false === is_string($productName)) {
            throw new BadRequestHttpException('Request requires "productName" to be a string.');
        }

        if(0 === strlen($productName)) {
            throw new BadRequestHttpException('Request requires "productName" to be a non-empty string.');
        }
    }

    private function assertProductCategory(float|bool|int|string|null $productCategory): void
    {
        if(false === is_string($productCategory)) {
            throw new BadRequestHttpException('Request requires "category" to be a string.');
        }

        if(0 === strlen($productCategory)) {
            throw new BadRequestHttpException('Request requires "category" to be a non-empty string.');
        }
    }

    private function assertAmount(float|bool|int|string|null $amount): void
    {
        if(false === is_string($amount)) {
            throw new BadRequestHttpException('Request requires "amount" to be a int.');
        }
    }
}
