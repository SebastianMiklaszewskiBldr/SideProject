<?php

namespace App\Tests\Shared\Infrastructure\Cache;

use App\Shared\Application\Cache\Ttl;
use App\Shared\Infrastructure\Cache\RedisAdapter;
use App\Tests\IntegrationTestCase;
use App\Tests\Stub\CacheableItemStub;
use App\Tests\TestAdapter\TestSymfonyRedisAdapter;

final class RedisAdapterTest extends IntegrationTestCase
{
    private RedisAdapterTestData $testData;
    private RedisAdapter $redisAdapter;
    private TestSymfonyRedisAdapter $testRedisAdapter;

    public function test_Store_ShouldSaveNewItem_WhenItDoesNotExistsInTheCacheAlready(): void
    {
        $cacheKey = $this->testData->getCacheKey();
        $cacheableItem = $this->testData->getCacheableItem();

        $this->redisAdapter->store(
            $cacheKey,
            $cacheableItem,
            $this->testData->getTtl()
        );

        $cachedItem = $this->testRedisAdapter->getItem($cacheKey->key);

        self::assertEquals($cachedItem, $cachedItem);
    }

    public function test_Store_ShouldOverrideStoredItem_WhenItemIsAlreadySavedInDatabase(): void
    {
        $cacheKey = $this->testData->getCacheKey();
        $cacheableItem = $this->testData->getCacheableItem();
        $this->testRedisAdapter->store($cacheKey, $cacheableItem, Ttl::infinite());
        $cachedItem = $this->testRedisAdapter->getItem($cacheKey->key);

        $this->redisAdapter->store($cacheKey, $this->testData->getCacheableItemTwo(), Ttl::infinite());
        $updatedCachedItem = $this->testRedisAdapter->getItem($cacheKey->key);

        /** @var CacheableItemStub $cachedItemValue */
        $cachedItemValue = $cachedItem->get();
        /** @var CacheableItemStub $updatedCachedItemValue */
        $updatedCachedItemValue = $updatedCachedItem->get();
        self::assertNotEquals($cachedItemValue, $updatedCachedItemValue);
        self::assertEquals($this->testData->getCacheableItemTwoName(), $updatedCachedItemValue->name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->testData = new RedisAdapterTestData();
        $this->redisAdapter = self::getContainer()->get(RedisAdapter::class);
        $this->testRedisAdapter = $this->getSymfonyRedisAdapter();
    }

    protected function tearDown(): void
    {
        $this->testRedisAdapter->clearCache($this->testData::CACHE_KEY_NAMESPACE);

        parent::tearDown();
    }
}
