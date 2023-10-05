<?php

namespace App\Shared\Infrastructure\Client;

use App\Shared\Application\Client\HttpClientInterface;
use App\Shared\Application\Client\UrlFactoryInterface;

final readonly class GuzzleAvailabilityModuleClientFactory
{
    public static function create(
        string $baseUrl,
        HttpClientInterface $httpClient,
        UrlFactoryInterface $urlFactory,
    ): GuzzleAvailabilityModuleClient {
        return new GuzzleAvailabilityModuleClient($httpClient, $urlFactory, new BaseUrl($baseUrl));
    }
}
