<?php

namespace App\Shared\Application\Event;

use App\Shared\Domain\Event\EventStoreInterface;

interface EventDispatcherInterface extends EventStoreInterface
{
    public function dispatch(): void;
}
