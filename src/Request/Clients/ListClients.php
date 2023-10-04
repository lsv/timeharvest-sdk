<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Request\PaginationTrait;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\Client\ClientsResponse;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface as HttpResponseInterface;

class ListClients extends AbstractRequest
{
    use PaginationTrait;

    public function __construct(
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        private readonly ?MetaResponse $meta = null,
    ) {
    }

    public function getUri(): string
    {
        return 'clients';
    }

    public function parseResponse(HttpResponseInterface $response): ClientsResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $clients = Serializer::deserializeArray($data['clients'], ClientData::class.'[]');

        return new ClientsResponse($meta, $clients);
    }

    protected function preQuery(array &$values): void
    {
        $this->setPagination($values);
    }
}
