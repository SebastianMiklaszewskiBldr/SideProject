<?php

namespace App\Shared\Infrastructure\Client;

final readonly class BaseUrl
{
    public function __construct(public string $baseUrl)
    {
    }
}
