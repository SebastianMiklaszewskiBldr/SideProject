<?php

namespace App\Tests\Shared\Infrastructure\Cache;

use App\Shared\Application\Cache\CacheKey;
use App\Shared\Application\Cache\Ttl;
use App\Tests\Stub\CacheableItemStub;

final readonly class RedisAdapterTestData
{
    public const CACHE_KEY_NAMESPACE = 'test';

    private const CACHE_KEY = self::CACHE_KEY_NAMESPACE . '.item.' . self::ITEM_ID;

    private const ITEM_ID = 'C22E3471-AA3B-48FB-9412-0E3F96D576DE';

    private const ITEM_NAME = 'item';

    private const ITEM_NAME_TWO = 'item2';

    public function getCacheKey(): CacheKey
    {
        return new CacheKey(self::CACHE_KEY);
    }

    public function getCacheableItem(): CacheableItemStub
    {
        return new CacheableItemStub(self::ITEM_ID, self::ITEM_NAME);
    }

    public function getTtl(): Ttl
    {
        return Ttl::infinite();
    }

    public function getCacheableItemTwo(): CacheableItemStub
    {
        return new CacheableItemStub(self::ITEM_ID, self::ITEM_NAME_TWO);
    }

    public function getCacheableItemTwoName(): string
    {
        return self::ITEM_NAME_TWO;
    }
}
