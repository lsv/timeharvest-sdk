<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Dto\User\CreateUserDto;
use Lsv\TimeharvestSdk\Dto\User\UpdateUserDto;
use Lsv\TimeharvestSdk\Request\Users\ArchiveUser;
use Lsv\TimeharvestSdk\Request\Users\CreateUser;
use Lsv\TimeharvestSdk\Request\Users\DeleteUser;
use Lsv\TimeharvestSdk\Request\Users\ListUsers;
use Lsv\TimeharvestSdk\Request\Users\MeUser;
use Lsv\TimeharvestSdk\Request\Users\RetrieveUser;
use Lsv\TimeharvestSdk\Request\Users\UpdateUser;
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

    public function createUser(CreateUserDto $dto): UserResponse
    {
        return $this->factory->request(new CreateUser($dto));
    }

    public function updateUser(int|UserData $user, UpdateUserDto $dto): UserResponse
    {
        return $this->factory->request(new UpdateUser($user, $dto));
    }

    public function archiveUser(int|UserData $user): UserResponse
    {
        return $this->factory->request(new ArchiveUser($user));
    }
}
