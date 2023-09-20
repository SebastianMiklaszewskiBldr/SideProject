<?php

namespace App\Tests\Read\ListProducts\Presentation;

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

        self::assertEquals(TestHttpStatusCode::SUCCESSFUL, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ListProductsTestData();
    }
}
