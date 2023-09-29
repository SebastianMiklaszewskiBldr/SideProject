<?php

namespace App\Read\ListProducts\Infrastructure;

use App\Read\ListProducts\Application\AvailableProductsProviderInterface;
use App\Shared\Application\Client\AvailabilityModuleClientInterface;
use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\StockId;

final readonly class AvailabilityModuleAvailableProductsProvider implements AvailableProductsProviderInterface
{
    public function __construct(
        private AvailabilityModuleClientInterface $availabilityModuleClient,
        private AvailableProductsResponseMapper $mapper
    ) {
    }

    /**
     * @inheritDoc
     */
    public function provide(StockId $stockId, Sort $sort, Paginator $paginator): array
    {
        $jsonResponse = $this->availabilityModuleClient->getSortedPageOfAvailableProducts($stockId, $sort, $paginator);

        return $this->mapper->map($jsonResponse);
    }
}
