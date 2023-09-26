<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateClient extends AbstractRequest
{
    public function __construct(
        private readonly int|ClientInfoData $client,
        public readonly ?string $name = null,
        public readonly ?bool $isActive = null,
        public readonly ?string $address = null,
        public readonly ?string $currency = null,
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        $clientId = $this->client instanceof ClientInfoData ? $this->client->id : $this->client;

        return "clients/$clientId";
    }

    public function parseResponse(ResponseInterface $response): ClientResponse
    {
        return new ClientResponse($this->deserializeData($response->toArray(), ClientData::class));
    }
}
