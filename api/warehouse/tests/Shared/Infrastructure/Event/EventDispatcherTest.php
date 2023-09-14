<?php

namespace App\Tests\Shared\Infrastructure\Event;

use App\Shared\Infrastructure\Event\EventDispatcher;
use App\Shared\Infrastructure\Event\EventQueueInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Log\Logger;

final class EventDispatcherTest extends TestCase
{
    private MockObject $eventQueueMock;

    public function test_Dispatch_ShouldNotPushAnythingOnQueue_WhenNoEventsStored(): void
    {
        $this->eventQueueMock
            ->expects(self::never())
            ->method('push');
        $eventDispatcher = $this->getEventDispatcher();

        $eventDispatcher->dispatch();
    }

    public function test_Dispatch_ShouldPushEventsOnQueue_WhenEventsAreStored(): void
    {
        $eventOne = new TestEvent();
        $eventTwo = new TestEvent();
        $eventThree = new TestEvent();
        $this->eventQueueMock
            ->expects(self::exactly(3))
            ->method('push');
        $eventDispatcher = $this->getEventDispatcher();
        $eventDispatcher->pushEvent($eventOne);
        $eventDispatcher->pushEvent($eventTwo);
        $eventDispatcher->pushEvent($eventThree);

        $eventDispatcher->dispatch();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->eventQueueMock = $this->createMock(EventQueueInterface::class);
    }

    private function getEventDispatcher(): EventDispatcher
    {
        return new EventDispatcher($this->eventQueueMock, new Logger());
    }
}
