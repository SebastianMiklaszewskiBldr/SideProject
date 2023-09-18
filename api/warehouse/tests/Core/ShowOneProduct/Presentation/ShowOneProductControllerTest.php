<?php

namespace App\Tests\Core\ShowOneProduct\Presentation;

use App\Tests\Core\ShowOneProduct\ShowOneProductTestData;
use App\Tests\DataBuilder\TestStockBuilder;
use App\Tests\SmokeTestCase;
use App\Tests\TestHttpStatusCode;
use App\Tests\TestUrlName;

final class ShowOneProductControllerTest extends SmokeTestCase
{
    private ShowOneProductTestData $testData;

    public function test_Show_ShouldReturn200StatusCode_WhenProductWasReturnedCorrectly(): void
    {
        $this->testData->loadData();

        $response = $this->sendGetRequest(
            TestUrlName::SHOW_ONE_PRODUCT,
            [
                'productId' => $this->testData->getProductId()->uuid,
            ]
        );

        self::assertEquals(TestHttpStatusCode::SUCCESSFUL->value, $response->getStatusCode());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ShowOneProductTestData(
            $this->getEntityManager(),
            self::getContainer()->get(TestStockBuilder::class)
        );

        $this->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
