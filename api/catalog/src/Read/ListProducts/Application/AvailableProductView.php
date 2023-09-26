<?php

namespace App\Read\ListProducts\Application;

use JsonSerializable;

final readonly class AvailableProductView implements JsonSerializable
{
    public function __construct(private string $id, private string $name, private int $quantity)
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'quantity' => $this->quantity,
        ];
    }
}
