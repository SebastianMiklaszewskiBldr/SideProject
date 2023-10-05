<?php

namespace App\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class IntegrationTestCase extends KernelTestCase
{
    protected ContainerInterface|Container $container;

    protected function setUp(): void
    {
        parent::setUp();

        $this->container = self::getContainer();
    }

    /**
     * @param array<Response> $responses
     */
    protected function mockGuzzleResponses(array $responses): Client
    {
        $guzzleMockHandler = new MockHandler($responses);
        $handlerStack = HandlerStack::create($guzzleMockHandler);

        return new Client(['handler' => $handlerStack]);
    }
}
