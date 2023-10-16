<?php

namespace App\Shared\Application\Cache;

final readonly class CacheKey
{
    public function __construct(public string $key)
    {
    }
}
