<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
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
