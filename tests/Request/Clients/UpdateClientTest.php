<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

use Lsv\TimeharvestSdk\Dto\Clients\UpdateClientDto;
use Lsv\TimeharvestSdk\Request\Clients\UpdateClient;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class UpdateClientTest extends RequestTestCase
{
    public function testUpdateClientById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/create_client.json'))
        );

        $dto = new UpdateClientDto('name', true, "address\nline2", 'EUR');
        $request = new UpdateClient(1, $dto);
        $response = $this->factory->request($request);

        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
        self::assertSame([
            'name' => 'name',
            'is_active' => true,
            'address' => "address\nline2",
            'currency' => 'EUR',
        ], $this->getHttpRequestOptions()['array']);

        self::assertArrayNotHasKey('client', $this->getHttpRequestOptions()['array']);

        self::assertSame('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertSame([], $this->getHttpRequestOptions()['query']);
        self::assertNull($response->getMeta());
        self::assertSame(5737336, $response->getData()->id);
    }

    public function testUpdateClientByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/create_client.json'))
        );

        $client = new ClientData();
        $client->id = 1;

        $dto = new UpdateClientDto();
        $request = new UpdateClient($client, $dto);
        $this->factory->request($request);
        self::assertStringEndsWith('1', $this->getHttpRequestOptions()['url']);
    }
}
