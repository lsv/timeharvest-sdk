<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Dto\Clients\CreateClientDto;
use Lsv\TimeharvestSdk\Dto\Clients\UpdateClientDto;
use Lsv\TimeharvestSdk\Request\Clients\ContactFactory;
use Lsv\TimeharvestSdk\Request\ClientsFactory;
use Symfony\Component\HttpClient\Response\MockResponse;

class ClientsFactoryTest extends RequestTestCase
{
    private ClientsFactory $clientFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->clientFactory = new ClientsFactory($this->factory);
    }

    public function testListClients(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/list_clients.json'))
        );

        $this->clientFactory->listClients();
        self::assertSame(
            [],
            $this->getHttpRequestOptions()['query']
        );
    }

    public function testGetClient(): void
    {
        $this->httpClient->setResponseFactory([
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/retrieve_client.json')),
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/retrieve_client.json')),
        ]);

        $this->clientFactory->getClient(1);
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);

        $client = new \Lsv\TimeharvestSdk\Response\Client\ClientData();
        $client->id = 1;
        $this->clientFactory->getClient($client);
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }

    public function testCreateClient(): void
    {
        $this->httpClient->setResponseFactory([
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/create_client.json')),
        ]);
        $dto = new CreateClientDto('name');
        $this->clientFactory->createClient($dto);
        self::assertSame([
            'name' => 'name',
        ], $this->getHttpRequestOptions()['array']);
    }

    public function testUpdateClient(): void
    {
        $this->httpClient->setResponseFactory([
            new MockResponse((string) file_get_contents(__DIR__.'/Clients/create_client.json')),
        ]);
        $dto = new UpdateClientDto('name');
        $this->clientFactory->updateClient(1, $dto);
        self::assertSame([
            'name' => 'name',
        ], $this->getHttpRequestOptions()['array']);
    }

    public function testDeleteClient(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse());
        $this->clientFactory->deleteClient(1);
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }

    public function testContacts(): void
    {
        /* @noinspection UnnecessaryAssertionInspection */
        self::assertInstanceOf(ContactFactory::class, $this->factory->clients()->contacts());
    }
}
