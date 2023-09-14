<?php

namespace App\Tests\Read\Product\ShowOne\Application;

use App\Read\Product\ShowOne\Application\ShowOneProductHandler;
use App\Shared\Application\Exception\NotFoundException;
use App\Tests\IntegrationTestCase;
use App\Tests\Read\Product\ShowOne\ShowOneProductTestData;

class ShowOneProductHandlerTest extends IntegrationTestCase
{

    private ShowOneProductTestData $testData;
    private ShowOneProductHandler $handler;

    public function test_Handle_ShouldThrowNotFoundException_WhenProductNotFound(): void
    {
        $this->expectException(NotFoundException::class);
        $this->handler->handle($this->testData->getQuery());
    }

    public function test_Handle_ShouldReturnProduct_WhenProductExistsInDataSource(): void
    {
        $result = $this->handler->handle($this->testData->getQuery());

        self::assertEquals($this->testData->getExpectedProductView(), $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ShowOneProductTestData();
        $this->handler = self::getContainer()->get(ShowOneProductHandler::class);
        $this->beginWriteEMTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackWriteEMTransaction();

        parent::tearDown();
    }
}
