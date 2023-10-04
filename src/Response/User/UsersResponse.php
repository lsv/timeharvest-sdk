<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\User;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class UsersResponse implements ResponseInterface
{
    /**
     * @param UserData[] $data
     */
    public function __construct(private MetaResponse $meta, private array $data)
    {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return UserData[]
     */
    public function getData(): array
    {
        return $this->data;
    }
}
