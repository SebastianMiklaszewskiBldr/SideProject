<?php

namespace App\Tests\TestAdapter;

use App\Shared\Application\Cache\CacheableInterface;
use App\Shared\Application\Cache\CacheKey;
use App\Shared\Application\Cache\Ttl;
use App\Shared\Infrastructure\Cache\RedisAdapterInterface;
use LogicException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\RedisAdapter as SymfonyRedisAdapter;

final class TestSymfonyRedisAdapter extends SymfonyRedisAdapter implements RedisAdapterInterface
{
    public function clearCache(string $cacheKeyNamespace): void
    {
        $this->doClear($cacheKeyNamespace);
    }

    public function store(CacheKey $cacheKey, CacheableInterface $item, Ttl $ttl): void
    {
        try {
            $cachedItem = $this->getItem($cacheKey->key);
        } catch (InvalidArgumentException $e) {
            throw new LogicException($e->getMessage());
        }

        $cachedItem->set($item)
            ->expiresAt(null);

        $this->save($cachedItem);
    }
}
