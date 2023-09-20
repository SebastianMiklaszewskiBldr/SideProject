<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Router;

final class SmokeTestCase extends WebTestCase
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

        $this->client->request(TestHttpMethod::GET->value, $url);

        return $this->client->getResponse();
    }
}
