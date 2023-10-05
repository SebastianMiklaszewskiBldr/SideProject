<?php

namespace App\Shared\Infrastructure\Client;

use App\Shared\Application\Client\UriInterface;
use App\Shared\Application\Client\Url;
use App\Shared\Application\Client\UrlFactoryInterface;

final readonly class UrlFactory implements UrlFactoryInterface
{
    public function __construct(private UrlBuilder $urlBuilder)
    {
    }

    /**
     * @inheritDoc
     */
    public function createUrl(BaseUrl $baseUrl, UriInterface $uri, array $uriParams, array $queryParams): Url
    {
        return $this->urlBuilder
            ->init($baseUrl)
            ->addUri($uri)
            ->setUriParams($uriParams)
            ->setQueryParams($queryParams)
            ->build();
    }
}
