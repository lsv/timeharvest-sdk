<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response;

class NullResponse implements ResponseInterface
{
    public function getMeta(): null
    {
        return null;
    }

    public function getData(): null
    {
        return null;
    }
}
