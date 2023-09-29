<?php

namespace App\Shared\Infrastructure\Client;

use App\Shared\Application\Client\UriInterface;
use App\Shared\Application\Client\Url;

final class UrlBuilder
{
    private string $url;

    public function __construct(private string $base)
    {
        $this->url = $base;
    }

    public function addUri(UriInterface $uri): self
    {
        $this->url = $this->url . $uri->getUri();

        return $this;
    }

    /**
     * @param array<string, string> $uriParams
     */
    public function setUriParams(array $uriParams): self
    {
        if (0 === count($uriParams)) {
            return $this;
        }

        $placeholders = $this->transformToPlaceholders(array_keys($uriParams));
        $values = array_values($uriParams);

        $this->url = str_replace($placeholders, $values, $this->url);

        return $this;
    }

    /**
     * @param array<string, string> $queryParams
     */
    public function setQueryParams(array $queryParams): self
    {
        if (0 === count($queryParams)) {
            return $this;
        }

        $queryParamsString = '?';

        $params = $this->transformQueryParamsToString($queryParams);

        $this->url .= sprintf('%s%s', $queryParamsString, $params);

        return $this;
    }

    public function build(): Url
    {
        $url = $this->url;

        $this->url = $this->base;

        return new Url($url);
    }

    /**
     * @param array<int, string> $keys
     * @return array<int, string>
     */
    private function transformToPlaceholders(array $keys): array
    {
        return array_map(static fn(string $key): string => sprintf('{%s}', $key), $keys);
    }

    private function transformQueryParamsToString(array $queryParams): string
    {
        $params = [];
        foreach ($queryParams as $key => $value) {
            $params[] = sprintf('%s=%s', $key, $value);
        }

        return implode('&', $params);
    }
}
