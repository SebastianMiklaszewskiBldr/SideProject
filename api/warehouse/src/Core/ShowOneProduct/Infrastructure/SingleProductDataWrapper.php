<?php

namespace App\Core\ShowOneProduct\Infrastructure;

use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockName;

final readonly class SingleProductDataWrapper
{
    public const ID_FIELD = 'id';

    public const NAME_FIELD = 'name';

    public const STOCK_NAME_FIELD = 'stock';

    public const AMOUNT_FIELD = 'amount';

    /**
     * @param array<string, mixed> $data
     */
    public function __construct(private array $data)
    {
    }

    public function getProductId(): ProductId
    {
        return new ProductId($this->data[self::ID_FIELD]);
    }

    public function getProductName(): ProductName
    {
        return new ProductName($this->data[self::NAME_FIELD]);
    }

    public function getAmount(): Amount
    {
        return new Amount($this->data[self::AMOUNT_FIELD]);
    }

    public function getStockName(): StockName
    {
        return new StockName($this->data[self::STOCK_NAME_FIELD]);
    }
}
