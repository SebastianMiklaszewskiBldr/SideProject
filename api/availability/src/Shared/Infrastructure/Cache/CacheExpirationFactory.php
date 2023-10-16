<?php

namespace App\Shared\Infrastructure\Cache;

use App\Shared\Application\Cache\Ttl;
use App\Shared\Application\Clock\ClockInterface;
use DateInterval;
use DateTimeImmutable;
use Exception;
use LogicException;

final readonly class CacheExpirationFactory
{
    public function __construct(private ClockInterface $clock)
    {
    }

    public function createFromTtl(Ttl $ttl): ?DateTimeImmutable
    {
        if ($ttl->isInfinite()) {
            return null;
        }

        $now = $this->clock->castToMutable($this->clock->now());

        try {
            $now->add(new DateInterval(sprintf('PT%dS', $ttl->ttl)));
        } catch (Exception $e) {
            throw new LogicException($e->getMessage());
        }

        return $this->clock->castToImmutable($now);
    }
}
