<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Request\Clients\CreateClient;
use Lsv\TimeharvestSdk\Request\Clients\DeleteClient;
use Lsv\TimeharvestSdk\Request\Clients\ListClients;
use Lsv\TimeharvestSdk\Request\Clients\RetrieveClient;
use Lsv\TimeharvestSdk\Request\Clients\UpdateClient;
use Lsv\TimeharvestSdk\Response\Client\ClientResponse;

class ClientsFactory
{
    public function listClients(bool $isActive = null, \DateTimeInterface $updatedSince = null, int $page = 1, int $perPage = 2000): ListClients
    {
        return new ListClients($isActive, $updatedSince, $page, $perPage);
    }

    public function getClient(int|ClientResponse $client): RetrieveClient
    {
        return new RetrieveClient($client);
    }

    public function createClient(string $name, bool $isActive = null, string $address = null, string $currency = null): CreateClient
    {
        return new CreateClient($name, $isActive, $address, $currency);
    }

    public function updateClient(int|ClientResponse $client, string $name, bool $isActive = null, string $address = null, string $currency = null): UpdateClient
    {
        return new UpdateClient($client, $name, $isActive, $address, $currency);
    }

    public function deleteClient(int|ClientResponse $client): DeleteClient
    {
        return new DeleteClient($client);
    }
}
