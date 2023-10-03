<?php

namespace App\Shared\Application\Client;

enum AvailabilityModuleClientUri: string implements UriInterface
{
    case GET_SORTED_PAGE_OF_AVAILABLE = '/api/stocks/{stockId}/products/available';

    public function getUri(): string
    {
        return $this->value;
    }
}
