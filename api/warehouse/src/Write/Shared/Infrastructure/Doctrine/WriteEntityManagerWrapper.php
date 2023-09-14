<?php

namespace App\Write\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\Decorator\EntityManagerDecorator;

final class WriteEntityManagerWrapper extends EntityManagerDecorator implements WriteEntityManagerInterface
{
}
