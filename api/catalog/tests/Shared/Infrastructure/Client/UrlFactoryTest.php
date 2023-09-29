<?php

namespace App\Tests\Shared\Infrastructure\Client;

use App\Shared\Infrastructure\Client\UrlBuilder;
use App\Shared\Infrastructure\Client\UrlFactory;
use PHPUnit\Framework\TestCase;

final class UrlFactoryTest extends TestCase
{
    private UrlFactoryTestData $testData;
    private UrlFactory $urlFactory;

    public function test_CreateUrl_ShouldCreateUrl_WhenNoUriOrQueryParamsProvided(): void
    {
        $url = $this->urlFactory->createUrl(
            uri: $this->testData->getUriWithoutParams(),
            uriParams: [],
            queryParams: []
        );

        self::assertEquals($this->testData->getExpectedUrlWithoutAnyParams()->url, $url->url);
    }

    public function test_CreateUrl_ShouldCreateUrlWithUriParams_WhenUriParamsProvided(): void
    {
        $url = $this->urlFactory->createUrl(
            uri: $this->testData->getUriWithUriParams(),
            uriParams: $this->testData->getUriParams(),
            queryParams: []
        );

        self::assertEquals($this->testData->getExpectedUrlWithUriParams()->url, $url->url);
    }

    public function test_CreateUrl_ShouldCreateUrlWithQueryParams_WhenQueryParamsProvided(): void
    {
        $url = $this->urlFactory->createUrl(
            uri: $this->testData->getUriWithoutParams(),
            uriParams: [],
            queryParams: $this->testData->getQueryParams()
        );

        self::assertEquals($this->testData->getExpectedUrlWithQueryParams()->url, $url->url);
    }

    public function test_CreateUrl_ShouldCreateUrlWithUriAndQueryParams_WhenUriAndUrlParamsProvided(): void
    {
        $url = $this->urlFactory->createUrl(
            $this->testData->getUriWithUriParams(),
            $this->testData->getUriParams(),
            $this->testData->getQueryParams()
        );

        self::assertEquals($this->testData->getExpectedUrlWithUriAndQueryParams()->url, $url->url);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new UrlFactoryTestData();
        $this->urlFactory = new UrlFactory(new UrlBuilder($this->testData->getBaseUrl()));
    }
}
