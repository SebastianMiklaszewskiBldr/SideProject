<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\Tests\Write\Product\Add\Application;

use App\Tests\IntegrationTestCase;
use App\Tests\Write\Product\Add\AddProductTestData;
use App\Write\Product\Add\Application\AddProductHandler;
use LogicException;

final class AddProductHandlerTest extends IntegrationTestCase
{
    private AddProductTestData $testData;
    private AddProductHandlerTestAssertions $assertions;
    private AddProductHandler $handler;

    public function test_Handle_ShouldThrowException_WhenStockNotFound(): void
    {
        $command = $this->testData->getCommand();

        $this->expectException(LogicException::class);
        $this->handler->handle($command);
    }

    public function test_Handle_ShouldSaveProduct_WhenProductCreatedWithoutExceptions(): void
    {
        $this->testData->loadStock();
        $command = $this->testData->getCommand();

        $this->handler->handle($command);

        $this->assertions->assertProductWasSaved($command->productId);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new AddProductTestData($this->getWriteEntityManager());
        $this->assertions = new AddProductHandlerTestAssertions($this, $this->getWriteEntityManager());
        $this->handler = self::getContainer()->get(AddProductHandler::class);

        $this->beginWriteEMTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackWriteEMTransaction();

        parent::tearDown();
    }
}
