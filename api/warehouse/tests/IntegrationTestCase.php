<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class IntegrationTestCase extends KernelTestCase
{
    protected function beginTransaction(): void
    {
        $this->getEntityManager()->beginTransaction();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return self::getContainer()->get(EntityManagerInterface::class);
    }

    protected function rollbackTransaction(): void
    {
        $this->getEntityManager()->rollback();
    }
}
