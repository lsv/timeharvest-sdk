<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response;

readonly class NullResponse implements ResponseInterface
{
    public function __construct(
        public int $statusCode,
    ) {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): null
    {
        return null;
    }
}
