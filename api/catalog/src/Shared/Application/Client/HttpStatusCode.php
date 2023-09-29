<?php

namespace App\Shared\Application\Client;

enum HttpStatusCode: int
{
    case INTERNAL_SERVER_ERROR = 500;
    case NOT_FOUND = 404;
}
