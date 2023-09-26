<?php

namespace App\Shared\Application\Client;

enum AvailabilityModuleClientUri: string
{
    case GET_SORTED_PAGE_OF_AVAILABLE = '/api/stocks/{stockId}/products/available';
}
