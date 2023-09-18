<?php

namespace App\Tests\Core\Shared\Infrastructure\Event;

use App\Core\Shared\Domain\Event\EventInterface;

final readonly class TestEvent implements EventInterface
{
    /**
     * @return array<int, mixed>
     */
    public function jsonSerialize(): array
    {
        return [];
    }
}
