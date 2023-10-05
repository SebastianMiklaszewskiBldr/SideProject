<?php

namespace App\Tests\Shared\Infrastructure\Client;

use App\Shared\Application\Client\UriInterface;
use App\Shared\Application\Client\Url;
use App\Shared\Infrastructure\Client\BaseUrl;

final readonly class UrlFactoryTestData
{
    public function getBaseUrl(): BaseUrl
    {
        return new BaseUrl('http://base.com');
    }

    public function getUriWithoutParams(): TestUri
    {
        return TestUri::URI_WITHOUT_PARAMS;
    }

    public function getExpectedUrlWithoutAnyParams(): Url
    {
        return new Url(sprintf('%s%s', $this->getBaseUrl()->baseUrl, $this->getUriWithoutParams()->getUri()));
    }

    public function getExpectedUrlWithUriParams(): Url
    {
        return new Url(sprintf('%s%s', $this->getBaseUrl()->baseUrl, $this->getPreparedUriParamsString()));
    }

    public function getUriWithUriParams(): UriInterface
    {
        return TestUri::URI_WITH_PARAMS;
    }

    /**
     * @return array<string, string>
     */
    public function getUriParams(): array
    {
        return [
            'param1' => 'test',
            'param2' => 'test2',
        ];
    }

    public function getQueryParams(): array
    {
        return [
            'param1' => 'test',
            'param2' => 'test2',
        ];
    }

    public function getExpectedUrlWithQueryParams(): Url
    {
        return new Url(
            sprintf(
                '%s%s%s',
                $this->getBaseUrl()->baseUrl,
                $this->getUriWithoutParams()->getUri(),
                $this->getPreparedQueryParamsString()
            )
        );
    }

    public function getExpectedUrlWithUriAndQueryParams(): Url
    {
        return
            new Url(
                sprintf(
                    '%s%s%s',
                    $this->getBaseUrl()->baseUrl,
                    $this->getPreparedUriParamsString(),
                    $this->getPreparedQueryParamsString()
                )
            );
    }

    private function getPreparedUriParamsString(): string
    {
        return '/api/test/test2';
    }

    private function getPreparedQueryParamsString(): string
    {
        return '?param1=test&param2=test2';
    }
}
