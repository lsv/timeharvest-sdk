<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Client;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Response;

readonly class ClientsResponse implements Response
{
    /**
     * @param ClientData[] $clients
     */
    public function __construct(private MetaResponse $meta, private array $clients)
    {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return ClientData[]
     */
    public function getData(): array
    {
        return $this->clients;
    }
}
