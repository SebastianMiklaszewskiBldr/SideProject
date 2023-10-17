<?php

namespace App\Shared\Application\Cache;

final readonly class Ttl
{
    private const INFINITE_TTL_VALUE = 0;

    private const ONE_DAY_TTL_VALUE = 86400;

    public function __construct(public int $ttl)
    {
    }

    public function isInfinite(): bool
    {
        return self::INFINITE_TTL_VALUE === $this->ttl;
    }

    public static function infinite(): self
    {
        return new self(self::INFINITE_TTL_VALUE);
    }

    public static function oneDay(): self
    {
        return new self(self::ONE_DAY_TTL_VALUE);
    }
}
