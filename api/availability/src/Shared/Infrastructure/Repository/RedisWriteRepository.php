<?php

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Application\Cache\CacheableInterface;
use App\Shared\Application\Cache\CacheKey;
use App\Shared\Application\Cache\Ttl;
use App\Shared\Application\Repository\WriteRepositoryInterface;
use App\Shared\Infrastructure\Cache\RedisAdapter;

final readonly class RedisWriteRepository implements WriteRepositoryInterface
{
    public function __construct(private RedisAdapter $redisAdapter)
    {
    }

    public function store(CacheKey $key, CacheableInterface $item, Ttl $ttl): void
    {
        $this->redisAdapter->store($key, $item, $ttl);
    }
}
