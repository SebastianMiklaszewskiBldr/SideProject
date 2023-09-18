<?php

namespace App\Infrastructure\Event;

use App\Core\Shared\Domain\Event\EventInterface;
use App\Core\Shared\Infrastructure\Event\EventQueueInterface;
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
