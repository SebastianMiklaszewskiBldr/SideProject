<?php

namespace App\Shared\Application\Client;

use App\Shared\Infrastructure\Client\BaseUrl;

interface UrlFactoryInterface
{
    /**
     * @param array<string, string> $uriParams
     * @param array<string, string> $queryParams
     */
    public function createUrl(BaseUrl $base, UriInterface $uri, array $uriParams, array $queryParams): Url;
}
