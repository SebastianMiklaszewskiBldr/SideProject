<?php

namespace App\Tests\Write\Product\Add\Presentation;

use App\Tests\SmokeTestCase;
use App\Tests\TestHttpStatusCode;
use App\Tests\TestUrlName;
use App\Write\Product\Add\AddProductTestData;

final class AddProductControllerTest extends SmokeTestCase
{
    private AddProductTestData $testData;

    public function test_Add_ShouldReturn200StatusCode_WhenNoExceptionOccurred(): void
    {
        $response = $this->sendPostRequest(TestUrlName::ADD_PRODUCT, [], $this->testData->getRequestBody());

        self::assertEquals(TestHttpStatusCode::RESOURCE_CREATED->value, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new AddProductTestData();
    }
}
