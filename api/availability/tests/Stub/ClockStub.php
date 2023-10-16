<?php

namespace App\Tests\Stub;

use App\Shared\Application\Clock\ClockInterface;
use DateTime;
use DateTimeImmutable;

final readonly class ClockStub implements ClockInterface
{
    public function __construct(private DateTimeImmutable $now, private ClockInterface $originalClock)
    {
    }

    public function castToMutable(DateTimeImmutable $dateTimeImmutable): DateTime
    {
        return $this->originalClock->castToMutable($dateTimeImmutable);
    }

    public function now(): DateTimeImmutable
    {
        return $this->now;
    }

    public function castToImmutable(DateTime $dateTime): DateTimeImmutable
    {
        return $this->originalClock->castToImmutable($dateTime);
    }
}
