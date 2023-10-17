<?php

namespace App\Tests\AddNewAvailableProduct\Application;

use App\AddNewAvailableProduct\Application\AddNewAvailableProductCommand;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;

final readonly class AddNewAvailableProductHandlerTestData
{
    public function getCommand(): AddNewAvailableProductCommand
    {
        return new AddNewAvailableProductCommand($this->getStockId(), $this->getProductId(), $this->getProductName());
    }

    public function getStockId(): StockId
    {
        return new StockId('6032EC54-05BF-401C-8D59-9A24F0E6589F');
    }

    public function getProductId(): ProductId
    {
        return new ProductId('5931A475-4CB8-4A0D-B3D9-4B4636B97BD4');
    }

    private function getProductName(): ProductName
    {
        return new ProductName('test product');
    }
}
