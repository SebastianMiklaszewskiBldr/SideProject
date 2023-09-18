<?php

namespace App\Core\ShowOneProduct\Presentation;

use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\ShowOneProduct\Application\ShowOneProductHandler;
use App\Core\ShowOneProduct\Application\ShowOneProductQuery;
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
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
