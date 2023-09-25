<?php

namespace App\Read\ListProducts\Presentation;

use App\Read\ListProducts\Application\ListProductsHandler;
use App\Read\ListProducts\Application\ListProductsQuery;
use App\Shared\Domain\ValueObject\StockId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ListProductsController extends AbstractController
{
    public function __construct(
        private readonly ListProductsRequestMapper $requestMapper,
        private readonly ListProductsHandler $handler,
    )
    {
    }

    public function list(string $stockId, Request $request): JsonResponse
    {
        $mappedRequest = $this->requestMapper->map($request);

        return new JsonResponse(
            $this->handler->handle(
                new ListProductsQuery(
                    new StockId($stockId),
                    $mappedRequest->sort, $mappedRequest->paginator
                )
            )
        );
    }
}
