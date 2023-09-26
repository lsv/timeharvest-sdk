<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Client;

use Lsv\TimeharvestSdk\Response\Response;

readonly class ClientResponse implements Response
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
