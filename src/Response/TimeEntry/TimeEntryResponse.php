<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\TimeEntry;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class TimeEntryResponse implements ResponseInterface
{
    public function __construct(
        private TimeEntryData $data
    ) {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): TimeEntryData
    {
        return $this->data;
    }
}
