<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Client;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class ClientResponse implements ResponseInterface
{
    public function __construct(private readonly ClientData $data)
    {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): ClientData
    {
        return $this->data;
    }
}
