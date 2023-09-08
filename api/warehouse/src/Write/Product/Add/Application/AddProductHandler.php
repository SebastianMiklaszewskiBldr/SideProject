<?php

namespace App\Write\Product\Add\Application;

use App\Write\Product\Add\Domain\CannotAddProductToStockException;
use App\Write\Product\Add\Domain\ProductFactory;
use App\Write\Product\Add\Domain\StockItemFactory;
use App\Write\Product\Shared\Application\Repository\StockRepositoryInterface;
use App\Write\Product\Shared\Application\Validator\ProductValidator;

final readonly class AddProductHandler
{
    public function __construct(
        private StockRepositoryInterface $stockRepository,
        private ProductFactory $productFactory,
        private ProductValidator $productValidator,
    )
    {
    }

    /**
     * @throws CannotAddProductToStockException
     */
    public function handle(AddProductCommand $command): void
    {
        $stock = $this->stockRepository->getOneById($command->stockId);

        $stock->addProduct(
            $command->productId,
            $command->productName,
            $command->productCategory,
            $command->amount,
            $this->productValidator,
            $this->productFactory
        );
    }
}
