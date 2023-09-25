<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

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

        $request = new CreateClient('name', true, "address\nline2", 'EUR');
        $response = $this->factory->request($request);

        self::assertSame([
            'name' => 'name',
            'is_active' => true,
            'address' => "address\nline2",
            'currency' => 'EUR',
        ], $this->getHttpRequestOptions()['array']);
        self::assertSame('POST', $this->getHttpRequestOptions()['method']);
        self::assertSame([], $this->getHttpRequestOptions()['query']);
        self::assertNull($response['meta']);
        self::assertSame(5737336, $response['data']->id);
    }
}