<?php

namespace App\Tests\Read\ListProducts\Presentation;

use App\Shared\Domain\ValueObject\SortOrder;
use App\Tests\Read\ListProducts\ListProductsTestData;
use App\Tests\SmokeTestCase;
use App\Tests\TestHttpStatusCode;
use App\Tests\TestUrlName;

final class ListProductsControllerTest extends SmokeTestCase
{
    private ListProductsTestData $testData;

    public function test_List_ShouldReturn200StatusCode_WhenNoExceptionOccurred(): void
    {
        $response = $this->sendGetRequest(TestUrlName::LIST_PRODUCTS, $this->testData->getRequestParams());

        self::assertEquals(TestHttpStatusCode::SUCCESSFUL->value, $response->getStatusCode());
    }

    public function test_List_ShouldReturn400StatusCode_WhenInvalidSortOrderValueProvided(): void
    {
        $response = $this->sendGetRequest(TestUrlName::LIST_PRODUCTS, [
            'stockId' => '3186E00F-206E-4FAD-9F9E-D54221618FAD',
            'sortOrder' => 'test',
            'sortBy' => 'name',
        ]);

        self::assertEquals(TestHttpStatusCode::BAD_REQUEST->value, $response->getStatusCode());
    }

    public function test_List_ShouldReturn400StatusCode_WhenInvalidSortByValueProvided(): void
    {
        $response = $this->sendGetRequest(TestUrlName::LIST_PRODUCTS, [
            'stockId' => '3186E00F-206E-4FAD-9F9E-D54221618FAD',
            'sortOrder' => SortOrder::ASC->value,
            'sortBy' => 'test',
        ]);

        self::assertEquals(TestHttpStatusCode::BAD_REQUEST->value, $response->getStatusCode());
    }

    public function test_List_ShouldReturn400StatusCode_WhenInvalidPaginationOffsetValueProvided(): void
    {
        $response = $this->sendGetRequest(TestUrlName::LIST_PRODUCTS, [
            'stockId' => '3186E00F-206E-4FAD-9F9E-D54221618FAD',
            'sortOrder' => 'test',
            'sortBy' => 'name',
            'offset' => -1,
            'limit' => 10
        ]);

        self::assertEquals(TestHttpStatusCode::BAD_REQUEST->value, $response->getStatusCode());
    }

    public function test_List_ShouldReturn400StatusCode_WhenInvalidPaginationLimitValueProvided(): void
    {
        $response = $this->sendGetRequest(TestUrlName::LIST_PRODUCTS, [
            'stockId' => '3186E00F-206E-4FAD-9F9E-D54221618FAD',
            'sortOrder' => 'test',
            'sortBy' => 'name',
            'offset' => 0,
            'limit' => 0
        ]);

        self::assertEquals(TestHttpStatusCode::BAD_REQUEST->value, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ListProductsTestData();
    }
}
