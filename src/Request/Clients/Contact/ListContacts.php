<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactsResponse;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListContacts extends AbstractRequest
{
    public function __construct(
        private readonly null|int|ClientInfoData $clientId = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        public readonly int $page = 1,
        public readonly int $perPage = 2000
    ) {
    }

    protected function preQuery(array &$values): void
    {
        $id = null;
        if (null !== $this->clientId) {
            $id = $this->clientId instanceof ClientInfoData ? $this->clientId->id : $this->clientId;
        }

        $values['clientId'] = $id;
    }

    public function getUri(): string
    {
        return '/contacts';
    }

    public function parseResponse(ResponseInterface $response): ContactsResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $contacts = Serializer::deserializeArray($data['contacts'], ContactData::class.'[]');

        return new ContactsResponse($meta, $contacts);
    }
}
