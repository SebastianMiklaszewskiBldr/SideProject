<?php

namespace App\AddNewAvailableProduct\Application;

use App\Shared\Application\Model\ProductFactory;
use App\Shared\Application\Repository\WriteRepositoryInterface;

final readonly class AddNewAvailableProductHandler
{
    public function __construct(private ProductFactory $productFactory, private WriteRepositoryInterface $repository)
    {
    }

    public function handle(AddNewAvailableProductCommand $command): void
    {
        $product = $this->productFactory->create($command->id, $command->name, $command->stockId);

        $this->repository->save($product);
    }
}
