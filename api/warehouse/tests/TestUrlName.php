<?php

namespace App\Tests;

enum TestUrlName: string
{
    case ADD_PRODUCT = 'api.products.add';
    case SHOW_ONE_PRODUCT = 'api.products.show';
}
