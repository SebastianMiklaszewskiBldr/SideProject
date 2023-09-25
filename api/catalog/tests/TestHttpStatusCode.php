<?php

namespace App\Tests;

enum TestHttpStatusCode: int
{
    case SUCCESSFUL = 200;
    case BAD_REQUEST = 400;
}
