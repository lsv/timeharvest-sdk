<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

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
use Lsv\TimeharvestSdk\Response\NullResponse;

readonly class ClientsFactory
{
    public function __construct(private RequestFactory $factory)
    {
    }

    public function listClients(bool $isActive = null, \DateTimeInterface $updatedSince = null, int $page = 1, int $perPage = 2000): ClientsResponse
    {
        return $this->factory->request(new ListClients($isActive, $updatedSince, $page, $perPage));
    }

    public function getClient(int|ClientInfoData $client): ClientResponse
    {
        return $this->factory->request(new RetrieveClient($client));
    }

    public function createClient(string $name, bool $isActive = null, string $address = null, string $currency = null): ClientResponse
    {
        return $this->factory->request(new CreateClient($name, $isActive, $address, $currency));
    }

    public function updateClient(int|ClientInfoData $client, string $name, bool $isActive = null, string $address = null, string $currency = null): ClientResponse
    {
        return $this->factory->request(new UpdateClient($client, $name, $isActive, $address, $currency));
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
