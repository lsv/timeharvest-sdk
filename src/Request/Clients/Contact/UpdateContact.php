<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Dto\Clients\Contact\UpdateContactDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateContact extends AbstractRequest
{
    public function __construct(
        private readonly int|ContactData $contact,
        public readonly UpdateContactDto $dto,
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        $id = $this->contact instanceof ContactData ? $this->contact->id : $this->contact;

        return '/contacts/'.$id;
    }

    public function parseResponse(ResponseInterface $response): ContactResponse
    {
        $data = $response->toArray();

        return new ContactResponse(Serializer::deserializeArray($data, ContactData::class));
    }
}
