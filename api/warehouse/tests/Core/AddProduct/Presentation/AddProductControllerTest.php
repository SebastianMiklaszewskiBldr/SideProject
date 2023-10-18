<?php

namespace App\Tests\Core\AddProduct\Presentation;

use App\Core\Shared\Domain\Event\ProductAdded;
use App\Tests\Core\AddProduct\AddProductTestData;
use App\Tests\SmokeTestCase;
use App\Tests\TestHttpStatusCode;
use App\Tests\TestUrlName;
use Symfony\Component\Messenger\Envelope;

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
        $this->assertDispatchedEvents();
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

    private function assertDispatchedEvents(): void
    {
        $dispatchedEvents = $this->getMessengerTransport('events')->getSent();
        self::assertCount(1, $dispatchedEvents);
        /** @var Envelope $dispatchedEvent */
        $dispatchedEvent = $dispatchedEvents[0];
        self::assertInstanceOf(ProductAdded::class, $dispatchedEvent->getMessage());
    }
}
