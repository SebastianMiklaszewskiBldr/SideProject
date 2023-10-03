<?php

namespace App\Shared\Infrastructure\Client;

use GuzzleHttp\Client;

final readonly class GuzzleHttpClientFactory
{
    public static function create(): Client
    {
        return new Client();
    }
}
