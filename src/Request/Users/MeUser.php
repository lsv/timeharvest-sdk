<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Users;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UserResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MeUser extends AbstractRequest
{
    public function getUri(): string
    {
        return '/users/me';
    }

    public function parseResponse(ResponseInterface $response): UserResponse
    {
        $data = $response->toArray();
        $user = Serializer::deserializeArray($data, UserData::class);

        return new UserResponse($user);
    }
}
