<?php

namespace App\Read\Product\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\Decorator\EntityManagerDecorator;

final class ReadEntityManagerWrapper extends EntityManagerDecorator implements ReadEntityManagerInterface
{
}
