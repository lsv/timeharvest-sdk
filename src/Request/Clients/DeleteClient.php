<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteClient extends AbstractRequest
{
    public function __construct(
        private readonly int|ClientInfoData $client
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        $clientId = $this->client instanceof ClientInfoData ? $this->client->id : $this->client;

        return 'clients/'.$clientId;
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse($response->getStatusCode());
    }
}
