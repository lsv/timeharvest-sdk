<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Users;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteUser extends AbstractRequest
{
    public function __construct(
        private readonly int|UserData $user
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        $id = $this->user instanceof UserData ? $this->user->id : $this->user;

        return "/users/{$id}";
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse($response->getStatusCode());
    }
}
