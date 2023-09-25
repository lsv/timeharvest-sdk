<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RetrieveClient extends AbstractRequest
{
    public function __construct(
        private readonly int|ClientResponse $client
    ) {
    }

    public function getUri(): string
    {
        $clientId = $this->client instanceof ClientResponse ? $this->client->id : $this->client;

        return 'clients/'.$clientId;
    }

    /**
     * @return array{meta: null, data: ClientResponse}
     */
    public function parseResponse(ResponseInterface $response): array
    {
        return [
            'meta' => null,
            'data' => $this->deserializeData($response->toArray(), ClientResponse::class),
        ];
    }

    public function getQuery(): array
    {
        return [];
    }
}
