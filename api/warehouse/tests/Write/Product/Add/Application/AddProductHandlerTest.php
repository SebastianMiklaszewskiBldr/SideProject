<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\Tests\Write\Product\Add\Application;

use App\Tests\IntegrationTestCase;
use App\Tests\Write\Product\Add\AddProductTestData;
use App\Write\Product\Add\Application\AddProductHandler;

final class AddProductHandlerTest extends IntegrationTestCase
{
    private AddProductTestData $testData;
    private AddProductHandlerTestAssertions $assertions;
    private AddProductHandler $handler;

    public function test_Handle_ShouldSaveProduct_WhenProductCreatedWithoutExceptions(): void
    {
        $command = $this->testData->getCommand();

        $this->handler->handle($command);

        $this->assertions->assertProductWasSaved($command->productId);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new AddProductTestData();
        $this->assertions = new AddProductHandlerTestAssertions($this);
        $this->handler = self::getContainer()->get(AddProductHandler::class);
    }
}
