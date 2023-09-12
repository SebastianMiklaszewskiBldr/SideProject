<?php

namespace App\Write\Product\Add\Application;

use App\Shared\Application\Exception\NotFoundException;
use App\Write\Product\Add\Domain\ProductFactory;
use App\Write\Product\Shared\Application\Repository\StockRepositoryInterface;
use App\Write\Product\Shared\Application\Validator\ProductValidator;
use LogicException;

final readonly class AddProductHandler
{
    public function __construct(
        private StockRepositoryInterface $stockRepository,
        private ProductFactory $productFactory,
        private ProductValidator $productValidator,
    ) {
    }

    public function handle(AddProductCommand $command): void
    {
        try {
            $stock = $this->stockRepository->getOneById($command->stockId);
        } catch (NotFoundException $e) {
            throw new LogicException($e->getMessage());
        }

        $this->stockRepository->wrapInTransaction(function () use ($stock, $command): void {
            $stock->addProduct(
                $command->productId,
                $command->productName,
                $command->productCategory,
                $command->amount,
                $this->productValidator,
                $this->productFactory
            );
        });
    }
}
