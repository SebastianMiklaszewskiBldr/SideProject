<?php

namespace App\Shared\Application\Cache;

final readonly class Ttl
{
    private const INFINITE_TTL_VALUE = 0;

    public function __construct(public int $ttl)
    {
    }

    public static function infinite(): self
    {
        return new self(self::INFINITE_TTL_VALUE);
    }

    public function isInfinite(): bool
    {
        return self::INFINITE_TTL_VALUE === $this->ttl;
    }
}
