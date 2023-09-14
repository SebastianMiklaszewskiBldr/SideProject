<?php

namespace App\Tests;

use App\Write\Product\Shared\Infrastructure\Doctrine\WriteEntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    protected function beginWriteEMTransaction(): void
    {
        $this->getWriteEntityManager()->beginTransaction();
    }

    protected function getWriteEntityManager(): EntityManagerInterface
    {
        return self::getContainer()->get(WriteEntityManagerInterface::class);
    }

    protected function rollbackWriteEMTransaction(): void
    {
        $this->getWriteEntityManager()->rollback();
    }
}
