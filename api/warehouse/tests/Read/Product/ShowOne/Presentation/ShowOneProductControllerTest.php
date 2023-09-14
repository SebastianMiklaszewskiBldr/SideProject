<?php

namespace App\Tests\Read\Product\ShowOne\Presentation;

use App\Tests\Read\Product\ShowOne\ShowOneProductTestData;
use App\Tests\SmokeTestCase;
use App\Tests\TestHttpStatusCode;
use App\Tests\TestUrlName;

final class ShowOneProductControllerTest extends SmokeTestCase
{
    private ShowOneProductTestData $testData;

    public function test_Show_ShouldReturn200StatusCode_WhenProductWasReturnedCorrectly(): void
    {
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

        $this->testData = new ShowOneProductTestData();
    }
}
