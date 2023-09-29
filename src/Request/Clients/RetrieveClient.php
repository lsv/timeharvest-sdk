<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RetrieveClient extends AbstractRequest
{
    public function __construct(
        private readonly int|ClientInfoData $client
    ) {
    }

    public function getUri(): string
    {
        $clientId = $this->client instanceof ClientInfoData ? $this->client->id : $this->client;

        return 'clients/'.$clientId;
    }

    public function parseResponse(ResponseInterface $response): ClientResponse
    {
        return new ClientResponse(Serializer::deserializeArray($response->toArray(), ClientData::class));
    }

    public function getQuery(): array
    {
        return [];
    }
}
