<?php

namespace App\Core\Shared\Infrastructure\Event;

use App\Core\Shared\Domain\Event\EventInterface;

interface EventQueueInterface
{
    public function push(EventInterface $event): void;
}
