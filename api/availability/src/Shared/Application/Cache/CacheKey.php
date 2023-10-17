<?php

namespace App\Shared\Application\Cache;

use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\StockId;

final readonly class CacheKey
{
    private const STOCK_NAMESPACE = 'stock';

    private const PRODUCT_NAMESPACE = 'product';

    public function __construct(public string $key)
    {
    }

    public static function product(StockId $stockId, ProductId $productId): self
    {
        return new self(
            self::composeKey([
                self::STOCK_NAMESPACE,
                $stockId->uuid,
                self::PRODUCT_NAMESPACE,
                $productId->uuid,
            ])
        );
    }

    /**
     * @param array<int, string> $keyParts
     */
    private static function composeKey(array $keyParts): string
    {
        return implode('.', $keyParts);
    }
}
