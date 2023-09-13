<?php

namespace App\Tests;

enum TestHttpStatusCode: int
{
    case RESOURCE_CREATED = 201;
    case SUCCESSFUL = 200;
}
