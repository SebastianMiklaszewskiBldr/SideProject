<?php

namespace App\Write\Product\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\Decorator\EntityManagerDecorator;

final class WriteEntityManagerWrapper extends EntityManagerDecorator implements WriteEntityManagerInterface
{
}
