<?php

namespace App\Write\Product\Add\Presentation;

use App\Shared\Domain\ValueObject\StockId;
use App\Write\Product\Add\Application\AddProductCommand;
use App\Write\Product\Add\Application\AddProductHandler;
use App\Write\Product\Add\Domain\CannotAddProductToStockException;
use App\Write\Product\Add\Infrastructure\AddProductRequestMapper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

final class AddProductController extends AbstractController
{
    public function __construct(
        private readonly AddProductRequestMapper $requestMapper,
        private readonly AddProductHandler $handler,
    )
    {
    }

    public function add(string $stockId, Request $request): JsonResponse
    {
        $mappedRequest = $this->requestMapper->map($request);

        try {
            $this->handler->handle(
                new AddProductCommand(
                    new StockId($stockId),
                    $mappedRequest->productId,
                    $mappedRequest->productName,
                    $mappedRequest->productCategory,
                    $mappedRequest->amount
                )
            );
        } catch(CannotAddProductToStockException $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return new JsonResponse(null, 201);
    }
}
