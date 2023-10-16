<?php

namespace App\Shared\Infrastructure\Cache;

use Redis;
use RedisException;
use Symfony\Component\Cache\Adapter\RedisAdapter as SymfonyRedisAdapter;

final readonly class RedisAdapterFactory
{
    /**
     * @throws RedisException
     */
    public static function create(string $host, int $port, CacheExpirationFactory $cacheExpirationFactory): RedisAdapter
    {
        $redisConnection = new Redis();
        $redisConnection->connect($host, $port);

        return new RedisAdapter(new SymfonyRedisAdapter($redisConnection), $cacheExpirationFactory);
    }
}
