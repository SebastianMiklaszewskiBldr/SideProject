<?php

namespace App\Core\AddProduct\Presentation;

use App\Core\AddProduct\Application\AddProductCommand;
use App\Core\AddProduct\Application\AddProductHandler;
use App\Core\AddProduct\Infrastructure\AddProductRequestMapper;
use App\Core\Shared\Domain\ValueObject\StockId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class AddProductController extends AbstractController
{
    public function __construct(
        private readonly AddProductRequestMapper $requestMapper,
        private readonly AddProductHandler $handler,
    ) {
    }

    public function add(Request $request, string $stockId): JsonResponse
    {
        $mappedRequest = $this->requestMapper->map($request);

        $this->handler->handle(
            new AddProductCommand(
                new StockId($stockId),
                $mappedRequest->productId,
                $mappedRequest->productName,
                $mappedRequest->productCategory,
                $mappedRequest->amount
            )
        );

        return new JsonResponse(null, 201);
    }
}
