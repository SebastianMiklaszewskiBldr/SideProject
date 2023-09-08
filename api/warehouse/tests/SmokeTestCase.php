<?php

/** @noinspection PhpFieldAssignmentTypeMismatchInspection */

namespace App\Tests;

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
     * @param array<string, mixed> $bodyParams
     */
    protected function sendPostRequest(TestUrlName $url, array $urlParams, array $bodyParams): Response
    {
        $url = $this->router->generate($url->value, $urlParams);

        $this->client->request(TestHttpMethod::POST->value, $url, $bodyParams);

        return $this->client->getResponse();
    }
}
