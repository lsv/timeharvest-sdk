<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteContact extends AbstractRequest
{
    public function __construct(
        private readonly int|ContactData $contact
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        $id = $this->contact instanceof ContactData ? $this->contact->id : $this->contact;

        return '/contacts/'.$id;
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse();
    }
}
