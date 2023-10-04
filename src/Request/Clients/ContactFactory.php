<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Dto\Clients\Contact\CreateContactDto;
use Lsv\TimeharvestSdk\Dto\Clients\Contact\UpdateContactDto;
use Lsv\TimeharvestSdk\Request\Clients\Contact\CreateContact;
use Lsv\TimeharvestSdk\Request\Clients\Contact\DeleteContact;
use Lsv\TimeharvestSdk\Request\Clients\Contact\ListContacts;
use Lsv\TimeharvestSdk\Request\Clients\Contact\RetrieveContact;
use Lsv\TimeharvestSdk\Request\Clients\Contact\UpdateContact;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactResponse;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactsResponse;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;

readonly class ContactFactory
{
    public function __construct(private RequestFactory $factory)
    {
    }

    public function listContacts(
        int|ClientData $client = null,
        \DateTimeInterface $updatedSince = null,
        MetaResponse $meta = null
    ): ContactsResponse {
        return $this->factory->request(new ListContacts($client, $updatedSince, $meta));
    }

    public function retrieveContact(int|ContactData $contact): ContactResponse
    {
        return $this->factory->request(new RetrieveContact($contact));
    }

    public function createContact(
        CreateContactDto $dto
    ): ContactResponse {
        return $this->factory->request(new CreateContact($dto));
    }

    public function updateContact(
        int|ContactData $contact,
        UpdateContactDto $dto,
    ): ContactResponse {
        return $this->factory->request(new UpdateContact($contact, $dto));
    }

    public function deleteContact(int|ContactData $contact): NullResponse
    {
        return $this->factory->request(new DeleteContact($contact));
    }
}
