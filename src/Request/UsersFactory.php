<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Request\Users\ListUsers;
use Lsv\TimeharvestSdk\RequestFactory;
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
}
