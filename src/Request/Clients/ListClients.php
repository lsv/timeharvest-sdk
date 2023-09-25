<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Symfony\Contracts\HttpClient\ResponseInterface as HttpResponseInterface;

class ListClients extends AbstractRequest
{
    public function __construct(
        public readonly ?bool $isActive,
        public readonly ?\DateTimeInterface $updatedSince,
        public readonly int $page,
        public readonly int $perPage,
    ) {
    }

    public function getUri(): string
    {
        return 'clients';
    }

    /**
     * @return array{meta: MetaResponse, data: ClientResponse[]}
     */
    public function parseResponse(HttpResponseInterface $response): array
    {
        $data = $response->toArray();
        $meta = $this->deserializeData($data, MetaResponse::class);
        $clients = $this->deserializeData($data['clients'], ClientResponse::class.'[]');

        return [
            'meta' => $meta,
            'data' => $clients,
        ];
    }
}
