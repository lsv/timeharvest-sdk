<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Request\ClientsFactory;
use Symfony\Component\HttpClient\Response\MockResponse;

class ClientsFactoryTest extends RequestTestCase
{
    private ClientsFactory $clientFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->clientFactory = new ClientsFactory();
    }

    public function testListClients(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/list_clients.json'))
        );

        $this->factory->request($this->clientFactory->listClients());
        self::assertSame(
            ['is_active' => null, 'updated_since' => null, 'page' => 1, 'per_page' => 2000],
            $this->getHttpRequestOptions()['query']
        );
    }

    public function testGetClient(): void
    {
        $this->httpClient->setResponseFactory([
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/retrieve_client.json')),
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/retrieve_client.json')),
        ]);

        $this->factory->request($this->clientFactory->getClient(1));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);

        $client = new \Lsv\TimeharvestSdk\Response\Client\ClientResponse();
        $client->id = 1;
        $this->factory->request($this->clientFactory->getClient($client));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }

    public function testCreateClient(): void
    {
        $this->httpClient->setResponseFactory([
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/create_client.json')),
        ]);
        $this->factory->request($this->clientFactory->createClient('name'));
        self::assertSame([
            'name' => 'name',
            'is_active' => null,
            'address' => null,
            'currency' => null,
        ], $this->getHttpRequestOptions()['array']);
    }

    public function testUpdateClient(): void
    {
        $this->httpClient->setResponseFactory([
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/create_client.json')),
        ]);
        $this->factory->request($this->clientFactory->updateClient(1, 'name'));
        self::assertSame([
            'name' => 'name',
            'is_active' => null,
            'address' => null,
            'currency' => null,
        ], $this->getHttpRequestOptions()['array']);
    }

    public function testDeleteClient(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse());
        $this->factory->request($this->clientFactory->deleteClient(1));
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }
}
