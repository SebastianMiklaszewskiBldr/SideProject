<?php

namespace App\Tests\Core\AddProduct\Presentation;

use App\Tests\Core\AddProduct\AddProductTestData;
use App\Tests\SmokeTestCase;
use App\Tests\TestHttpStatusCode;
use App\Tests\TestUrlName;

final class AddProductControllerTest extends SmokeTestCase
{
    private AddProductTestData $testData;

    public function test_Add_ShouldReturn200StatusCode_WhenNoExceptionOccurred(): void
    {
        $this->testData->loadStock();

        $response = $this->sendPostRequest(
            TestUrlName::ADD_PRODUCT,
            [
                'stockId' => $this->testData->getStockId()->uuid,
            ],
            $this->testData->getRequestBody()
        );

        self::assertEquals(TestHttpStatusCode::RESOURCE_CREATED->value, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new AddProductTestData($this->getEntityManager());

        $this->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
