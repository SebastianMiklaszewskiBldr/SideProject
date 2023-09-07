<?php

namespace App\Write\Product\Add\Presentation;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class AddProductController extends AbstractController
{
    public function add(Request $request): JsonResponse
    {
        return new JsonResponse(null,201);
    }
}
