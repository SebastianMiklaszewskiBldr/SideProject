<?php

namespace App\Write\Product\Shared\Infrastructure\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use LogicException;

final readonly class WriteEntityManagerFactory
{
    public static function create(ManagerRegistry $managerRegistry): WriteEntityManagerWrapper
    {
        $manager = $managerRegistry->getManager('write');

        if(false === $manager instanceof EntityManagerInterface) {
            throw new LogicException('Manager has to be instance of EntityManagerInterface.');
        }

        return new WriteEntityManagerWrapper($manager);
    }
}
