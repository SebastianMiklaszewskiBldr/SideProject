<?php

namespace App\Read\Product\ShowOne\Application;

use JsonSerializable;

final readonly class SingleProductView implements JsonSerializable
{
    private const ID_FIELD = 'id';
    private const NAME_FIELD = 'name';
    private const STOCK_NAME_FIELD = 'stock';
    private const AMOUNT_FIELD = 'amount';

    public function __construct(
        private string $id,
        private string $name,
        private string $stockName,
        private int $amount,
    )
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            self::ID_FIELD => $this->id,
            self::NAME_FIELD => $this->name,
            self::STOCK_NAME_FIELD => $this->stockName,
            self::AMOUNT_FIELD => $this->amount,
        ];
    }
}
