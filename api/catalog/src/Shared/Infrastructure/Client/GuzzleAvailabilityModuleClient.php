<?php

namespace App\Shared\Infrastructure\Client;

use App\Shared\Application\Client\AvailabilityModuleClientInterface;
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
        $url = $this->urlFactory->createUrl();

        return $this->client->sendGetRequest();
    }
}
