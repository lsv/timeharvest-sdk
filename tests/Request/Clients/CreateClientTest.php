<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

use Lsv\TimeharvestSdk\Dto\Clients\CreateClientDto;
use Lsv\TimeharvestSdk\Request\Clients\CreateClient;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class CreateClientTest extends RequestTestCase
{
    public function testCreateClient(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/create_client.json'))
        );

        $dto = new CreateClientDto('name', true, "address\nline2", 'EUR');
        $request = new CreateClient($dto);
        $response = $this->factory->request($request);

        self::assertSame([
            'name' => 'name',
            'is_active' => true,
            'address' => "address\nline2",
            'currency' => 'EUR',
        ], $this->getHttpRequestOptions()['array']);
        self::assertSame('POST', $this->getHttpRequestOptions()['method']);
        self::assertSame([], $this->getHttpRequestOptions()['query']);
        self::assertNull($response->getMeta());
        self::assertSame(5737336, $response->getData()->id);
    }
}
