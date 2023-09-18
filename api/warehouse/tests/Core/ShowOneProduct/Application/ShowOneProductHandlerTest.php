<?php

namespace App\Tests\Core\ShowOneProduct\Application;

use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\ShowOneProduct\Application\ShowOneProductHandler;
use App\Tests\Core\ShowOneProduct\ShowOneProductTestData;
use App\Tests\DataBuilder\TestStockBuilder;
use App\Tests\IntegrationTestCase;

final class ShowOneProductHandlerTest extends IntegrationTestCase
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
        $this->testData->loadData();

        $result = $this->handler->handle($this->testData->getQuery());

        self::assertEquals($this->testData->getExpectedProductView(), $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new ShowOneProductTestData(
            $this->getEntityManager(),
            self::getContainer()->get(TestStockBuilder::class)
        );
        $this->handler = self::getContainer()->get(ShowOneProductHandler::class);

        $this->beginTransaction();
    }

    protected function tearDown(): void
    {
        $this->rollbackTransaction();

        parent::tearDown();
    }
}
