<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response;

interface ResponseInterface
{
    public function getMeta(): null|MetaResponse;

    public function getData(): mixed;
}
