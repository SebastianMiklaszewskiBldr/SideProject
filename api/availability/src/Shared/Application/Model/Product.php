<?php

namespace App\Shared\Application\Model;

use App\Shared\Application\Cache\CacheableInterface;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;

final readonly class Product implements CacheableInterface
{
    public const PRODUCT_ID_JSON_KEY = 'id';
    public const PRODUCT_NAME_JSON_KEY = 'name';
    public const STOCK_ID_JSON_KEY = 'stockId';

    public function __construct(public ProductId $id, public ProductName $name, public StockId $stockId)
    {
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            self::PRODUCT_ID_JSON_KEY => $this->id,
            self::PRODUCT_NAME_JSON_KEY => $this->name,
            self::STOCK_ID_JSON_KEY => $this->stockId,
        ];
    }
}
