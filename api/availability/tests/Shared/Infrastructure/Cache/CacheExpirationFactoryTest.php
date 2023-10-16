<?php

namespace App\Tests\Shared\Infrastructure\Cache;

use App\Shared\Application\Cache\Ttl;
use App\Shared\Infrastructure\Cache\CacheExpirationFactory;
use App\Shared\Infrastructure\Clock\PsrClock;
use App\Tests\Stub\ClockStub;
use App\Tests\UnitTestCase;
use DateTimeImmutable;

final class CacheExpirationFactoryTest extends UnitTestCase
{
    private DateTimeImmutable $now;
    private CacheExpirationFactory $cacheExpirationFactory;

    public function test_CreateFromTtl_ShouldReturnFutureDate_WhenNonZeroTTLProvided(): void
    {
        $ttl = new Ttl(60);
        $expectedExpirationDate = new DateTimeImmutable('01-01-2023T00:01:00');

        $expirationDate = $this->cacheExpirationFactory->createFromTtl($ttl);

        self::assertEquals($expectedExpirationDate, $expirationDate);
    }

    public function test_CreateFromTtl_ShouldReturnNull_WhenTtlIsInfinite(): void
    {
        $ttl = Ttl::infinite();

        $expirationDate = $this->cacheExpirationFactory->createFromTtl($ttl);

        self::assertNull($expirationDate);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->now = new DateTimeImmutable('01-01-2023T00:00:00');

        $clockStub = new ClockStub($this->now, new PsrClock());
        $this->cacheExpirationFactory = new CacheExpirationFactory($clockStub);
    }
}
