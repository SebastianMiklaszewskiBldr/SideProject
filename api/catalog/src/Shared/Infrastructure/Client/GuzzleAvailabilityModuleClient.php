<?php

namespace App\Shared\Infrastructure\Client;

use App\Shared\Application\Client\AvailabilityModuleClientInterface;
use App\Shared\Application\Client\AvailabilityModuleClientUri;
use App\Shared\Application\Client\HttpClientInterface;
use App\Shared\Application\Client\UrlFactoryInterface;
use App\Shared\Domain\ValueObject\Paginator;
use App\Shared\Domain\ValueObject\Sort;
use App\Shared\Domain\ValueObject\StockId;

final readonly class GuzzleAvailabilityModuleClient implements AvailabilityModuleClientInterface
{
    public function __construct(private HttpClientInterface $client, private UrlFactoryInterface $urlFactory)
    {
    }

    public function getSortedPageOfAvailableProducts(StockId $stockId, Sort $sort, Paginator $paginator): string
    {
        $url = $this->urlFactory->createUrl(
            AvailabilityModuleClientUri::GET_SORTED_PAGE_OF_AVAILABLE,
            ['stockId' => $stockId->uuid],
            [
                'sortBy' => $sort->sortBy->getSortBy(),
                'sortOrder' => $sort->sortOrder->value,
                'offset' => $paginator->offset->offset,
                'limit' => $paginator->limit->limit
            ]
        );

        return $this->client->sendGetRequest($url)->getBody();
    }
}
