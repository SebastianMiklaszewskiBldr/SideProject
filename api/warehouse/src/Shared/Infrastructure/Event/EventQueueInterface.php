<?php

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\EventInterface;

interface EventQueueInterface
{

    public function push(EventInterface $event): void;
}
