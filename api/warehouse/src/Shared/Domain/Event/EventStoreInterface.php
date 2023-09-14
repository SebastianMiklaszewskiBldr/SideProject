<?php

namespace App\Shared\Domain\Event;

interface EventStoreInterface
{
    public function pushEvent(EventInterface $event): void;
}
