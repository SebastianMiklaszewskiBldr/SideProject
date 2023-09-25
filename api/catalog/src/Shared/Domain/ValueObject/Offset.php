<?php

namespace App\Shared\Domain\ValueObject;


final readonly class Offset
{

    public function __construct(public int $offset)
    {
    }
}
