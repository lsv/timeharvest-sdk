<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Users;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UsersResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListUsers extends AbstractRequest
{
    public function __construct(
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        public readonly int $page = 1,
        public readonly int $perPage = 2000
    ) {
    }

    public function getUri(): string
    {
        return '/users';
    }

    public function parseResponse(ResponseInterface $response): UsersResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $users = Serializer::deserializeArray($data['users'], UserData::class.'[]');

        return new UsersResponse($meta, $users);
    }
}
