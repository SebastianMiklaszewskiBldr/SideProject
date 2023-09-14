<?php

namespace App\Shared\Infrastructure\Event;

use App\Shared\Application\Event\EventDispatcherInterface;
use App\Shared\Domain\Event\EventInterface;
use Psr\Log\LoggerInterface;

final class EventDispatcher implements EventDispatcherInterface
{
    /**
     * @var array<int, EventInterface>
     */
    private array $events;

    public function __construct(private readonly EventQueueInterface $queue, private readonly LoggerInterface $logger)
    {
        $this->events = [];
    }

    public function dispatch(): void
    {
        $events = $this->events;

        foreach($events as $event) {
            $this->queue->push($event);

            $this->logger->info(sprintf('Event: %s pushed on queue.', $event::class));
        }

        $this->events = [];
    }

    public function pushEvent(EventInterface $event): void
    {
        $this->events[] = $event;
    }
}
