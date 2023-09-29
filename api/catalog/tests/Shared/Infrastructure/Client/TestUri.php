<?php

namespace App\Tests\Shared\Infrastructure\Client;

use App\Shared\Application\Client\UriInterface;

enum TestUri: string implements UriInterface
{
    case URI_WITHOUT_PARAMS = '/api/test';
    case URI_WITH_PARAMS = '/api/{param1}/{param2}';

    public function getUri(): string
    {
        return $this->value;
    }
}
