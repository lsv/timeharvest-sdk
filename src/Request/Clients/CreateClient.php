<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CreateClient extends AbstractRequest
{
    public function __construct(
        public readonly string $name,
        public readonly ?bool $isActive = null,
        public readonly ?string $address = null,
        public readonly ?string $currency = null,
    ) {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return 'clients';
    }

    public function parseResponse(ResponseInterface $response): ClientResponse
    {
        return new ClientResponse($this->deserializeData($response->toArray(), ClientData::class));
    }
}
