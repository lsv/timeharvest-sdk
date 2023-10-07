<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Dto\Clients\CreateClientDto;
use Lsv\TimeharvestSdk\Dto\Clients\UpdateClientDto;
use Lsv\TimeharvestSdk\Request\Clients\ContactFactory;
use Lsv\TimeharvestSdk\Request\Clients\CreateClient;
use Lsv\TimeharvestSdk\Request\Clients\DeleteClient;
use Lsv\TimeharvestSdk\Request\Clients\ListClients;
use Lsv\TimeharvestSdk\Request\Clients\RetrieveClient;
use Lsv\TimeharvestSdk\Request\Clients\UpdateClient;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;
use Lsv\TimeharvestSdk\Response\Client\ClientsResponse;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;

readonly class ClientsFactory
{
    public function __construct(private RequestFactory $factory)
    {
    }

    public function listClients(bool $isActive = null, \DateTimeInterface $updatedSince = null, MetaResponse $meta = null): ClientsResponse
    {
        return $this->factory->request(new ListClients($isActive, $updatedSince, $meta));
    }

    public function retrieveClient(int|ClientInfoData $client): ClientResponse
    {
        return $this->factory->request(new RetrieveClient($client));
    }

    public function createClient(CreateClientDto $dto): ClientResponse
    {
        return $this->factory->request(new CreateClient($dto));
    }

    public function updateClient(int|ClientInfoData $client, UpdateClientDto $dto): ClientResponse
    {
        return $this->factory->request(new UpdateClient($client, $dto));
    }

    public function deleteClient(int|ClientInfoData $client): NullResponse
    {
        return $this->factory->request(new DeleteClient($client));
    }

    public function contacts(): ContactFactory
    {
        return new ContactFactory($this->factory);
    }
}
