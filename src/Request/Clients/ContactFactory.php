<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Clients;

use Lsv\TimeharvestSdk\Request\Clients\Contact\CreateContact;
use Lsv\TimeharvestSdk\Request\Clients\Contact\DeleteContact;
use Lsv\TimeharvestSdk\Request\Clients\Contact\ListContacts;
use Lsv\TimeharvestSdk\Request\Clients\Contact\RetrieveContact;
use Lsv\TimeharvestSdk\Request\Clients\Contact\UpdateContact;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\Client\ClientData;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactResponse;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactsResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;

readonly class ContactFactory
{
    public function __construct(private RequestFactory $factory)
    {
    }

    public function listContacts(
        int|ClientData $client = null,
        \DateTimeInterface $updatedSince = null,
        int $page = 1,
        int $perPage = 2000
    ): ContactsResponse {
        return $this->factory->request(new ListContacts($client, $updatedSince, $page, $perPage));
    }

    public function retrieveContact(int|ContactData $contact): ContactResponse
    {
        return $this->factory->request(new RetrieveContact($contact));
    }

    public function createContact(
        int|ClientInfoData $clientId,
        string $firstName,
        string $lastName = null,
        string $title = null,
        string $email = null,
        string $phoneOffice = null,
        string $phoneMobile = null,
        string $fax = null
    ): ContactResponse {
        return $this->factory->request(new CreateContact($clientId, $firstName, $lastName, $title, $email, $phoneOffice, $phoneMobile, $fax));
    }

    public function updateContact(
        int|ContactData $contact,
        int|ClientInfoData $clientId = null,
        string $firstName = null,
        string $lastName = null,
        string $title = null,
        string $email = null,
        string $phoneOffice = null,
        string $phoneMobile = null,
        string $fax = null
    ): ContactResponse {
        return $this->factory->request(new UpdateContact($contact, $clientId, $firstName, $lastName, $title, $email, $phoneOffice, $phoneMobile, $fax));
    }

    public function deleteContact(int|ContactData $contact): NullResponse
    {
        return $this->factory->request(new DeleteContact($contact));
    }
}
