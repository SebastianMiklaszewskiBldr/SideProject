<?php

namespace App\Tests\Core\Shared\Infrastructure\Repository;

use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\Shared\Application\Repository\StockRepositoryInterface;
use App\Tests\IntegrationTestCase;

final class StockRepositoryTest extends IntegrationTestCase
{
    private StockRepositoryTestData $testData;
    private StockRepositoryInterface $repository;

    public function test_GetOneById_ShouldThrowException_WhenStockNotFound(): void
    {
        $this->expectException(NotFoundException::class);
        $this->repository->getOneById($this->testData->getStockId());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new StockRepositoryTestData($this->getEntityManager());
        $this->repository = self::getContainer()->get(StockRepositoryInterface::class);
    }
}
