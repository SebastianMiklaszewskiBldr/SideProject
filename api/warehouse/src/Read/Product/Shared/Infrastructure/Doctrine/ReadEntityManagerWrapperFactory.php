<?php

namespace App\Read\Product\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;

final readonly class ReadEntityManagerWrapperFactory
{
    public static function create(ManagerRegistry $managerRegistry): ReadEntityManagerInterface
    {
        $manager = $managerRegistry->getManager('read');

        if (false === $manager instanceof EntityManagerInterface) {
            throw new LogicException('Manager has to be instance of EntityManagerInterface.');
        }

        return new ReadEntityManagerWrapper($manager);
    }
}
