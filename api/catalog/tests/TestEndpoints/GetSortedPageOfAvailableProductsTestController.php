<?php

namespace App\Tests\TestEndpoints;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class GetSortedPageOfAvailableProductsTestController extends AbstractController
{
    public function getValidResponse(): JsonResponse
    {
        return new JsonResponse(
            [
                [
                    'id' => '9F1D3509-3957-4824-836C-8F5E92C30E10',
                    'name' => 'product 1',
                    'quantity' => 10
                ]
            ]
        );
    }

    public function getEmptyResponse(): JsonResponse
    {
        return new JsonResponse([]);
    }
}
