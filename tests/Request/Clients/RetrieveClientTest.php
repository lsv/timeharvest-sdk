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

        self::assertNull($response['meta']);
        self::assertSame(5735776, $response['data']->id);
        self::assertSame('123 Industries', $response['data']->name);
    }

    public function testGetClientWithObject(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse(
            (string) file_get_contents(__DIR__.'/retrieve_client.json')
        ));

        $client = new \Lsv\TimeharvestSdk\Response\Client\ClientResponse();
        $client->id = 1;
        $this->factory->request(new RetrieveClient($client));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }
}
