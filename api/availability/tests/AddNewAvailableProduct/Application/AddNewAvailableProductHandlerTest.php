<?php

namespace App\Tests\AddNewAvailableProduct\Application;

use App\AddNewAvailableProduct\Application\AddNewAvailableProductHandler;
use App\Shared\Application\Cache\CacheKey;
use App\Shared\Application\Model\Product;
use App\Tests\IntegrationTestCase;
use App\Tests\TestAdapter\TestSymfonyRedisAdapter;

final class AddNewAvailableProductHandlerTest extends IntegrationTestCase
{
    private AddNewAvailableProductHandlerTestData $testData;
    private AddNewAvailableProductHandler $handler;
    private TestSymfonyRedisAdapter $symfonyRedisAdapter;

    public function test_Handle_ShouldSaveNewAvailableProduct(): void
    {
        $this->handler->handle($this->testData->getCommand());

        /** @var Product $savedProduct */
        $savedProduct = $this->symfonyRedisAdapter->getItem(
            CacheKey::product($this->testData->getStockId(), $this->testData->getProductId())->key
        )->get();

        self::assertEquals($this->testData->getProductId()->uuid, $savedProduct->id->uuid);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new AddNewAvailableProductHandlerTestData();
        $this->handler = self::getContainer()->get(AddNewAvailableProductHandler::class);
        $this->symfonyRedisAdapter = $this->getSymfonyRedisAdapter();
    }
}
