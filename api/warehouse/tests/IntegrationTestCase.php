<?php

namespace App\Tests;

use App\Read\Shared\Infrastructure\Doctrine\ReadEntityManagerInterface;
use App\Write\Shared\Infrastructure\Doctrine\WriteEntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    protected function beginWriteConnectionTransaction(): void
    {
        $this->getWriteEntityManager()->beginTransaction();
    }

    protected function getWriteEntityManager(): EntityManagerInterface
    {
        return self::getContainer()->get(WriteEntityManagerInterface::class);
    }

    protected function rollbackWriteConnectionTransaction(): void
    {
        $this->getWriteEntityManager()->rollback();
    }

    protected function beginReadConnectionTransaction(): void
    {
        $this->getReadEntityManager()->beginTransaction();
    }

    protected function getReadEntityManager(): ReadEntityManagerInterface
    {
        return self::getContainer()->get(ReadEntityManagerInterface::class);
    }

    protected function rollbackReadConnectionTransaction(): void
    {
        $this->getReadEntityManager()->rollback();
    }
}
