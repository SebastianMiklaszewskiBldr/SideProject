<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\Tests\Core\AddProduct\Application;

use App\Core\AddProduct\Application\AddProductHandler;
use App\Tests\Core\AddProduct\AddProductTestData;
use App\Tests\IntegrationTestCase;
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

        $this->testData = new AddProductTestData($this->getEntityManager());
        $this->assertions = new AddProductHandlerTestAssertions($this, $this->getEntityManager());
        $this->handler = self::getContainer()->get(AddProductHandler::class);

        $this->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
