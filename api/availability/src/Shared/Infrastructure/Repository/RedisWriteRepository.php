<?php

namespace App\Shared\Infrastructure\Repository;

use App\Shared\Application\Cache\CacheKey;
use App\Shared\Application\Cache\Ttl;
use App\Shared\Application\Model\Product;
use App\Shared\Application\Repository\WriteRepositoryInterface;
use App\Shared\Infrastructure\Cache\RedisAdapter;

final readonly class RedisWriteRepository implements WriteRepositoryInterface
{
    public function __construct(private RedisAdapter $redisAdapter)
    {
    }

    public function save(Product $product): void
    {
        $this->redisAdapter->store(CacheKey::product($product->stockId, $product->id), $product, Ttl::oneDay());
    }
}
