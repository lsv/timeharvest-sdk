<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Users;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UserResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ArchiveUser extends AbstractRequest
{
    public function __construct(
        private readonly int|UserData $user
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    protected function preQuery(array &$values): void
    {
        $values['is_active'] = false;
    }

    public function getUri(): string
    {
        $id = $this->user instanceof UserData ? $this->user->id : $this->user;

        return "/users/{$id}";
    }

    public function parseResponse(ResponseInterface $response): UserResponse
    {
        $data = $response->toArray();
        $user = Serializer::deserializeArray($data, UserData::class);

        return new UserResponse($user);
    }
}
