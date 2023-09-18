<?php

namespace App\Core\Shared\Domain\Event;

interface EventStoreInterface
{
    public function pushEvent(EventInterface $event): void;
}
