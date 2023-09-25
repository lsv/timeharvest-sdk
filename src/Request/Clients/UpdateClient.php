<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateClient extends AbstractRequest
{
    public function __construct(
        private readonly int|ClientResponse $client,
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
        $clientId = $this->client instanceof ClientResponse ? $this->client->id : $this->client;

        return "clients/$clientId";
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
}
