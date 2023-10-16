<?php

namespace App\Shared\Infrastructure\Cache;

use App\Shared\Application\Cache\CacheableInterface;
use App\Shared\Application\Cache\CacheKey;
use App\Shared\Application\Cache\Ttl;

interface RedisAdapterInterface
{
    public function store(CacheKey $cacheKey, CacheableInterface $item, Ttl $ttl): void;
}
