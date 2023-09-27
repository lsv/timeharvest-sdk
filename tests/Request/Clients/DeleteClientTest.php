<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

use Lsv\TimeharvestSdk\Request\Clients\DeleteClient;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class DeleteClientTest extends RequestTestCase
{
    public function testDeleteClientWithId(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse());

        $response = $this->factory->request(new DeleteClient(1));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);

        self::assertNull($response->getMeta());
        self::assertNull($response->getData());
    }

    public function testDeleteClientWithObject(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse());

        $client = new \Lsv\TimeharvestSdk\Response\Client\ClientData();
        $client->id = 1;
        $this->factory->request(new DeleteClient($client));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }
}
