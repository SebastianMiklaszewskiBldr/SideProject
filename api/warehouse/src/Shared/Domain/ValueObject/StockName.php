<?php

namespace App\Shared\Domain\ValueObject;

final readonly class StockName
{
    private const DEFAULT_STOCK_NAME = 'Default';

    public function __construct(public string $name)
    {
    }

    public static function default(): self
    {
        return new self(self::DEFAULT_STOCK_NAME);
    }
}
