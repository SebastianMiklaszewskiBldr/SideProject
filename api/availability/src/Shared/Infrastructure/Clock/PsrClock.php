<?php

namespace App\Shared\Infrastructure\Clock;

use App\Shared\Application\Clock\ClockInterface;
use DateTime;
use DateTimeImmutable;

final readonly class PsrClock implements ClockInterface
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }

    public function castToMutable(DateTimeImmutable $dateTimeImmutable): DateTime
    {
        return DateTime::createFromImmutable($dateTimeImmutable);
    }

    public function castToImmutable(DateTime $dateTime): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($dateTime);
    }
}
