<?php

namespace App\Tests;

use App\Tests\TestAdapter\TestSymfonyRedisAdapter;
use Redis;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class IntegrationTestCase extends KernelTestCase
{
    private const REDIS_HOST_CONTAINER_PARAMETER_NAME = 'app.redis.client.host';

    private const REDIS_PORT_CONTAINER_PARAMETER_NAME = 'app.redis.client.port';

    protected function getSymfonyRedisAdapter(): TestSymfonyRedisAdapter
    {
        $redis = new Redis();

        $redis->connect(
            self::getContainer()->getParameter(self::REDIS_HOST_CONTAINER_PARAMETER_NAME),
            self::getContainer()->getParameter(self::REDIS_PORT_CONTAINER_PARAMETER_NAME)
        );

        return new TestSymfonyRedisAdapter($redis);
    }
}
