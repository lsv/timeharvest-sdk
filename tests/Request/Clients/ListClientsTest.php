<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

use Lsv\TimeharvestSdk\Request\Clients\ListClients;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\Exception\ServerException;
use Symfony\Component\HttpClient\Response\MockResponse;

class ListClientsTest extends RequestTestCase
{
    public function testGetClients(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_clients.json'))
        );

        $updatedSince = new \DateTimeImmutable();
        $request = new ListClients(true, $updatedSince);
        $response = $this->factory->request($request);

        self::assertSame(
            ['is_active' => true, 'updated_since' => $updatedSince->format('c')],
            $this->getHttpRequestOptions()['query']
        );

        $meta = $response->getMeta();
        self::assertNotNull($meta);

        self::assertSame(2, $meta->totalEntries);
        self::assertSame(2000, $meta->perPage);
        self::assertSame(1, $meta->totalPages);
        self::assertSame($meta->nextPage, 'https://api.harvestapp.com/v2/clients?page=1&per_page=2000');
        self::assertNull($meta->previousPage);
        self::assertSame(1, $meta->page);
        self::assertSame('https://api.harvestapp.com/v2/clients?page=1&per_page=2000', $meta->links['first']);
        self::assertSame('https://api.harvestapp.com/v2/clients?page=1&per_page=2000', $meta->links['next']);
        self::assertNull($meta->links['previous']);
        self::assertSame('https://api.harvestapp.com/v2/clients?page=1&per_page=2000', $meta->links['last']);

        self::assertCount(2, $response->getData());
        $data = $response->getData()[0];
        self::assertInstanceOf(ClientData::class, $data);
        self::assertSame('123 Industries', $data->name);
        self::assertSame('0a39d3e33c8058cf7c3f8097d854c64e', $data->statementKey);
        self::assertStringContainsString('Anytown', $data->address);
        self::assertTrue($data->isActive);
        self::assertSame('EUR', $data->currency);
        self::assertSame('2017-06-26', $data->createdAt->format('Y-m-d'));
        self::assertSame('2017-06-26', $data->updatedAt->format('Y-m-d'));
    }

    public function testPaging(): void
    {
        $meta = new MetaResponse();
        $meta->nextPage = 'https://api.harvestapp.com/v2/clients?page=2&per_page=20';

        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_clients.json'))
        );
        $request = new ListClients(meta: $meta);
        $this->factory->request($request);
        self::assertSame(
            ['page' => 2, 'per_page' => 20],
            $this->getHttpRequestOptions()['query']
        );
    }

    public static function httpErrorCodesResponseProvider(): \Generator
    {
        yield [403];
        yield [404];
        yield [422];
        yield [429];
        yield [500, ServerException::class];
    }

    /**
     * @dataProvider httpErrorCodesResponseProvider
     *
     * @param class-string<\Throwable> $exception
     */
    public function testHttpErrorCodesResponse(int $code, string $exception = ClientException::class): void
    {
        $this->expectException($exception);

        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => $code])
        );
        $this->factory->clients()->listClients();
    }
}
