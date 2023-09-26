<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateContact extends AbstractRequest
{
    public function __construct(
        private readonly int|ContactData $contact,
        public readonly null|int|ClientInfoData $clientId = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $title = null,
        public readonly ?string $email = null,
        public readonly ?string $phoneOffice = null,
        public readonly ?string $phoneMobile = null,
        public readonly ?string $fax = null
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

        return new ContactResponse($this->deserializeData($data, ContactData::class));
    }
}
