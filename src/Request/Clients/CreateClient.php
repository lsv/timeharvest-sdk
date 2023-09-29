<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Dto\Clients\CreateClientDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CreateClient extends AbstractRequest
{
    public function __construct(
        public readonly CreateClientDto $dto
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
        return new ClientResponse(Serializer::deserializeArray($response->toArray(), ClientData::class));
    }
}
