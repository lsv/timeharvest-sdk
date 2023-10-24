<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Users;

use Lsv\TimeharvestSdk\Dto\User\UpdateUserDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UserInfoData;
use Lsv\TimeharvestSdk\Response\User\UserResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateUser extends AbstractRequest
{
    public function __construct(
        private readonly int|UserInfoData $user,
        public readonly UpdateUserDto $update,
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        $id = $this->user instanceof UserInfoData ? $this->user->id : $this->user;

        return 'users/'.$id;
    }

    public function parseResponse(ResponseInterface $response): UserResponse
    {
        return new UserResponse(Serializer::deserializeArray($response->toArray(), UserData::class));
    }
}
