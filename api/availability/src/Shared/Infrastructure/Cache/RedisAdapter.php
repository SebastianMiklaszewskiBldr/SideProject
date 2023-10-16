<?php

namespace App\Shared\Infrastructure\Cache;

use App\Shared\Application\Cache\CacheableInterface;
use App\Shared\Application\Cache\CacheKey;
use App\Shared\Application\Cache\Ttl;
use LogicException;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\RedisAdapter as SymfonyRedisAdapter;

final readonly class RedisAdapter implements RedisAdapterInterface
{
    public function __construct(
        private SymfonyRedisAdapter $redisAdapter,
        private CacheExpirationFactory $cacheExpirationFactory,
    ) {
    }

    public function store(CacheKey $cacheKey, CacheableInterface $item, Ttl $ttl): void
    {
        try {
            $cachedItem = $this->redisAdapter->getItem($cacheKey->key);
        } catch (InvalidArgumentException $e) {
            throw new LogicException($e->getMessage());
        }

        $expiresAt = $this->cacheExpirationFactory->createFromTtl($ttl);

        $cachedItem->set($item)
            ->expiresAt($expiresAt);

        $this->redisAdapter->save($cachedItem);
    }
}
