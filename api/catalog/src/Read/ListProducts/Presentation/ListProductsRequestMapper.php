<?php

namespace App\Read\ListProducts\Presentation;

use Symfony\Component\HttpFoundation\Request;

final readonly class ListProductsRequestMapper
{
    public function map(Request $request): ListProductsRequest
    {

        return new ListProductsRequest();
    }
}
