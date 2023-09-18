<?php

namespace App\Tests;

use App\Tests\Stub\EventStoreStub;
use PHPUnit\Framework\TestCase;

class UnitTestCase extends TestCase
{
    protected function getEventStoreStub(): EventStoreStub
    {
        return new EventStoreStub();
    }
}
