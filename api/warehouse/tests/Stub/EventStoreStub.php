<?php

namespace App\Tests\Stub;

use App\Core\Shared\Domain\Event\EventInterface;
use App\Core\Shared\Domain\Event\EventStoreInterface;

final class EventStoreStub implements EventStoreInterface
{
    /**
     * @var array<int, EventInterface>
     */
    private array $events;

    public function __construct()
    {
        $this->events = [];
    }

    public function pushEvent(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
