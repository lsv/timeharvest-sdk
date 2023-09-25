<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteClient extends AbstractRequest
{
    public function __construct(
        private readonly int|ClientResponse $client
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        $clientId = $this->client instanceof ClientResponse ? $this->client->id : $this->client;

        return 'clients/'.$clientId;
    }

    /**
     * @return array{meta: null, data: null}
     */
    public function parseResponse(ResponseInterface $response): array
    {
        return [
            'meta' => null,
            'data' => null,
        ];
    }
}
