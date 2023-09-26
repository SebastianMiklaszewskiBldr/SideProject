<?php

namespace App\Read\ListProducts\Application;

final readonly class ListProductsHandler
{
    public function __construct(
        private AvailableProductsProviderInterface $availableProductsProvider,
        private AvailableProductViewMapper $mapper,
    ) {
    }

    /**
     * @return array<AvailableProductView>
     */
    public function handle(ListProductsQuery $query): array
    {
        return $this->mapper->map(
            $this->availableProductsProvider->provide(
                $query->stockId,
                $query->sort,
                $query->paginator
            )
        );
    }
}
