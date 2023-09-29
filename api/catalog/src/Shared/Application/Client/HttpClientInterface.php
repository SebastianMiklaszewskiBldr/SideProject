<?php

namespace App\Shared\Application\Client;

use Psr\Http\Message\ResponseInterface;

interface HttpClientInterface
{
    public function sendGetRequest(Url $url): ResponseInterface;
}
