<?php

namespace App\Core\AddProduct\Application;

use App\Core\AddProduct\Domain\ProductFactory;
use App\Core\Shared\Application\Event\EventDispatcherInterface;
use App\Core\Shared\Application\Exception\NotFoundException;
use App\Core\Shared\Application\Repository\StockRepositoryInterface;
use App\Core\Shared\Domain\Validator\ProductValidator;
use LogicException;

final readonly class AddProductHandler
{
    public function __construct(
        private StockRepositoryInterface $stockRepository,
        private ProductFactory $productFactory,
        private ProductValidator $productValidator,
        private EventDispatcherInterface $eventDispatcher,
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
                $this->productFactory,
                $this->eventDispatcher
            );

            $this->eventDispatcher->dispatch();
        });
    }
}
