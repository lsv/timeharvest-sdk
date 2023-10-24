<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\TimeEntry;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class TimeEntriesResponse implements ResponseInterface
{
    /**
     * @param TimeEntryData[] $timeEntries
     */
    public function __construct(
        private MetaResponse $meta,
        private array $timeEntries,
    ) {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return TimeEntryData[]
     */
    public function getData(): array
    {
        return $this->timeEntries;
    }
}
