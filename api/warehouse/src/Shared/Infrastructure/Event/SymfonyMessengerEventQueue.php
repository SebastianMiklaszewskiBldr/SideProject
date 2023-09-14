<?php

namespace App\Shared\Infrastructure\Event;

use App\Shared\Domain\Event\EventInterface;
use Symfony\Component\Messenger\MessageBusInterface;

final readonly class SymfonyMessengerEventQueue implements EventQueueInterface
{
    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function push(EventInterface $event): void
    {
        $this->messageBus->dispatch($event);
    }
}
