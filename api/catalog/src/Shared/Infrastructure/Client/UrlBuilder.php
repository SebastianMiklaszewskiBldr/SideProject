<?php

namespace App\Shared\Infrastructure\Client;

use App\Shared\Application\Client\UriInterface;
use App\Shared\Application\Client\Url;
use LogicException;

final class UrlBuilder
{
    private ?string $url;

    public function __construct()
    {
        $this->url = null;
    }

    public function init(BaseUrl $baseUrl): self
    {
        $this->url = $baseUrl->baseUrl;

        return $this;
    }

    public function addUri(UriInterface $uri): self
    {
        if (null === $this->url) {
            throw new LogicException('You need to initialize base URL. Call init() method.');
        }

        $this->url = $this->url . $uri->getUri();

        return $this;
    }

    /**
     * @param array<string, string> $uriParams
     */
    public function setUriParams(array $uriParams): self
    {
        if (null === $this->url) {
            throw new LogicException('You need to initialize base URL. Call init() method.');
        }

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
        if (null === $this->url) {
            throw new LogicException('You need to initialize base URL. Call init() method.');
        }

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
        if (null === $this->url) {
            throw new LogicException('You need to initialize base URL. Call init() method.');
        }

        $url = $this->url;

        $this->url = null;

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
