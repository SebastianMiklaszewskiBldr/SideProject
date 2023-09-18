<?php

namespace App\Core\Shared\Application\Event;

use App\Core\Shared\Domain\Event\EventStoreInterface;

interface EventDispatcherInterface extends EventStoreInterface
{
    public function dispatch(): void;
}
