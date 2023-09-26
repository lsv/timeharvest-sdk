<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response;

interface Response
{
    public function getMeta(): null|MetaResponse;

    public function getData(): mixed;
}
