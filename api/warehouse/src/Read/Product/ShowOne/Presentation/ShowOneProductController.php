<?php

namespace App\Read\Product\ShowOne\Presentation;

use App\Read\Product\ShowOne\Application\ShowOneProductHandler;
use App\Read\Product\ShowOne\Application\ShowOneProductQuery;
use App\Shared\Application\Exception\NotFoundException;
use App\Shared\Domain\ValueObject\ProductId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ShowOneProductController extends AbstractController
{
    public function __construct(private readonly ShowOneProductHandler $handler)
    {
    }

    public function show(string $productId): JsonResponse
    {
        try {
            return new JsonResponse(
                $this->handler->handle(new ShowOneProductQuery(new ProductId($productId)))
            );
        } catch(NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
