<?php

namespace App\Shared\Infrastructure\Client;

use App\Shared\Application\Client\HttpClientInterface;
use App\Shared\Application\Client\HttpStatusCode;
use App\Shared\Application\Client\Url;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final readonly class GuzzleHttpClient implements HttpClientInterface
{
    public function __construct(private Client $client)
    {
    }

    public function sendGetRequest(Url $url): ResponseInterface
    {
        try {
            return $this->client->get($url->url);
        } catch (GuzzleException $e) {
            $this->rethrowException($e);
        }
    }

    private function rethrowException(GuzzleException $e): void
    {
        match (true) {
            HttpStatusCode::INTERNAL_SERVER_ERROR->value === $e->getCode() => throw new LogicException(
                $e->getMessage()
            ),
            HttpStatusCode::NOT_FOUND->value === $e->getCode() => throw new NotFoundHttpException($e->getMessage()),
        };
    }
}
