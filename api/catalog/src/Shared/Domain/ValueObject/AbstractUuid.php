<?php

namespace App\Shared\Domain\ValueObject;

abstract readonly class AbstractUuid
{
    public function __construct(public string $uuid)
    {
    }
}
