<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Dto\Clients\Contact\CreateContactDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CreateContact extends AbstractRequest
{
    public function __construct(
        public readonly CreateContactDto $dto,
    ) {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/contacts';
    }

    public function parseResponse(ResponseInterface $response): ContactResponse
    {
        $data = $response->toArray();

        return new ContactResponse(Serializer::deserializeArray($data, ContactData::class));
    }
}
