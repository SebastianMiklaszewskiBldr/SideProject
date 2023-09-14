<?php

/** @noinspection PhpFieldAssignmentTypeMismatchInspection */

namespace App\Tests;

use App\Read\Shared\Infrastructure\Doctrine\ReadEntityManagerInterface;
use App\Write\Shared\Infrastructure\Doctrine\WriteEntityManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @param array<string, string> $urlParams
     */
    protected function sendGetRequest(TestUrlName $url, array $urlParams): Response
    {
        $url = $this->router->generate($url->value, $urlParams);

        $this->client->request(TestHttpMethod::GET->value, $url);

        return $this->client->getResponse();
    }

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
