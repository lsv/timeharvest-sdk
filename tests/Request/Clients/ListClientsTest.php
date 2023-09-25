<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

use Lsv\TimeharvestSdk\Request\Clients\ListClients;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class ListClientsTest extends RequestTestCase
{
    public function testGetClients(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_clients.json'))
        );

        $updatedSince = new \DateTimeImmutable();
        $request = new ListClients(true, $updatedSince, 2, 5);
        $response = $this->factory->request($request);

        self::assertSame(
            ['is_active' => true, 'updated_since' => $updatedSince->format('c'), 'page' => 2, 'per_page' => 5],
            $this->getHttpRequestOptions()['query']
        );

        $meta = $response['meta'];
        self::assertNotNull($meta);

        self::assertSame(2, $meta->totalEntries);
        self::assertSame(2000, $meta->perPage);
        self::assertSame(1, $meta->totalPages);
        self::assertNull($meta->nextPage);
        self::assertNull($meta->previousPage);
        self::assertSame(1, $meta->page);
        self::assertSame('https://api.harvestapp.com/v2/clients?page=1&per_page=2000', $meta->links['first']);
        self::assertNull($meta->links['next']);
        self::assertNull($meta->links['previous']);
        self::assertSame('https://api.harvestapp.com/v2/clients?page=1&per_page=2000', $meta->links['last']);

        self::assertCount(2, $response['data']);
        $data = $response['data'][0];
        self::assertInstanceOf(ClientResponse::class, $data);
        self::assertSame('123 Industries', $data->name);
        self::assertSame('0a39d3e33c8058cf7c3f8097d854c64e', $data->statementKey);
        self::assertStringContainsString('Anytown', $data->address);
        self::assertTrue($data->isActive);
        self::assertSame('EUR', $data->currency);
        self::assertSame('2017-06-26', $data->createdAt->format('Y-m-d'));
        self::assertSame('2017-06-26', $data->updatedAt->format('Y-m-d'));
    }

    public function testNoAuthorizationResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 403])
        );
    }

    public function testNotFoundResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 404])
        );
    }

    public function testErrorInProcessingResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 422])
        );
    }

    public function testThrottleResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 429])
        );
    }

    public function testServerErrorResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 500])
        );
    }
}