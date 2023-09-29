<?php

namespace App\Shared\Application\Client;

interface UrlFactoryInterface
{
    /**
     * @param array<string, string> $uriParams
     * @param array<string, string> $queryParams
     */
    public function createUrl(UriInterface $uri, array $uriParams, array $queryParams): Url;
}
