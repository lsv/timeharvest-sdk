<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\User;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class UserResponse implements ResponseInterface
{
    public function __construct(private UserData $user)
    {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): UserData
    {
        return $this->user;
    }
}
