<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

use Lsv\TimeharvestSdk\Request\Clients\RetrieveClient;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class RetrieveClientTest extends RequestTestCase
{
    public function testGetClientWithId(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse(
            (string) file_get_contents(__DIR__.'/retrieve_client.json')
        ));

        $response = $this->factory->request(new RetrieveClient(1));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);

        self::assertNull($response->getMeta());
        self::assertSame(5735776, $response->getData()->id);
        self::assertSame('123 Industries', $response->getData()->name);
    }

    public function testGetClientWithObject(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse(
            (string) file_get_contents(__DIR__.'/retrieve_client.json')
        ));

        $client = new \Lsv\TimeharvestSdk\Response\Client\ClientData();
        $client->id = 1;
        $this->factory->request(new RetrieveClient($client));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }
}
