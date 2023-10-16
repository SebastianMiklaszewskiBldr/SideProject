<?php

namespace App\Shared\Application\Clock;

use DateTime;
use DateTimeImmutable;
use Psr\Clock\ClockInterface as PsrClockInterface;

interface ClockInterface extends PsrClockInterface
{
    public function castToMutable(DateTimeImmutable $dateTimeImmutable): DateTime;

    public function castToImmutable(DateTime $dateTime): DateTimeImmutable;
}
