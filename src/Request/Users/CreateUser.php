<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Users;

use Lsv\TimeharvestSdk\Dto\User\CreateUserDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UserResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CreateUser extends AbstractRequest
{
    public function __construct(
        public readonly CreateUserDto $create,
    ) {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return 'users';
    }

    public function parseResponse(ResponseInterface $response): UserResponse
    {
        return new UserResponse(Serializer::deserializeArray($response->toArray(), UserData::class));
    }
}
