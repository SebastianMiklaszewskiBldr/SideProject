<?php

namespace App\Read\ListProducts\Presentation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ListProductsController extends AbstractController
{

    public function list(string $stockId, Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
