<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Users;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Request\PaginationTrait;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UsersResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListUsers extends AbstractRequest
{
    use PaginationTrait;

    public function __construct(
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        private readonly ?MetaResponse $meta = null,
    ) {
    }

    public function getUri(): string
    {
        return '/users';
    }

    protected function preQuery(array &$values): void
    {
        self::setPagination($this->meta, $values);
    }

    public function parseResponse(ResponseInterface $response): UsersResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $users = Serializer::deserializeArray($data['users'], UserData::class.'[]');

        return new UsersResponse($meta, $users);
    }
}
