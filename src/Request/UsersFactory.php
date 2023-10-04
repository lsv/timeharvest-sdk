<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Request\Users\DeleteUser;
use Lsv\TimeharvestSdk\Request\Users\ListUsers;
use Lsv\TimeharvestSdk\Request\Users\MeUser;
use Lsv\TimeharvestSdk\Request\Users\RetrieveUser;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UserResponse;
use Lsv\TimeharvestSdk\Response\User\UsersResponse;

readonly class UsersFactory
{
    public function __construct(
        private RequestFactory $factory
    ) {
    }

    public function listUsers(bool $isActive = null, \DateTimeInterface $updatedSince = null, int $page = 1, int $perPage = 2000): UsersResponse
    {
        return $this->factory->request(new ListUsers($isActive, $updatedSince, $page, $perPage));
    }

    public function me(): UserResponse
    {
        return $this->factory->request(new MeUser());
    }

    public function retrieveUser(int|UserData $userData): UserResponse
    {
        return $this->factory->request(new RetrieveUser($userData));
    }

    public function deleteUser(int|UserData $userData): NullResponse
    {
        return $this->factory->request(new DeleteUser($userData));
    }
}
