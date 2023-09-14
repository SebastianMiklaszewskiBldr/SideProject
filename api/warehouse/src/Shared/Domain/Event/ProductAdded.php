<?php

namespace App\Shared\Domain\Event;

final readonly class ProductAdded implements EventInterface
{
    public function __construct(
        public string $productId,
        public string $productName,
        public string $stockId,
        public string $stockName,
        public int $amount,
    )
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'productId' => $this->productId,
            'productName' => $this->productName,
            'stockId' => $this->stockId,
            'stockName' => $this->stockName,
            'amount' => $this->amount,
        ];
    }
}
