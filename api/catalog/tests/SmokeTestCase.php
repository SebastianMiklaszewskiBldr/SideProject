<?php

namespace App\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

class SmokeTestCase extends WebTestCase
{
    private KernelBrowser $client;
    private Router $router;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = self::createClient();
        $this->router = $this->client->getContainer()->get('router');
    }

    /**
     * @param array<string, string> $urlParams
     */
    protected function sendGetRequest(TestUrlName $url, array $urlParams): Response
    {
        $url = $this->router->generate($url->value, $urlParams);

        $this->client->request(TestHttpMethod::GET->name, $url);

        return $this->client->getResponse();
    }

    /**
     * @param array<\GuzzleHttp\Psr7\Response> $responses
     */
    protected function mockGuzzleResponses(array $responses): Client
    {
        $guzzleMockHandler = new MockHandler($responses);
        $handlerStack = HandlerStack::create($guzzleMockHandler);

        return new Client(['handler' => $handlerStack]);
    }
}
