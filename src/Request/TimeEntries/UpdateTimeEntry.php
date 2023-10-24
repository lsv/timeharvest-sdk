<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\TimeEntries;

use Lsv\TimeharvestSdk\Dto\TimeEntries\UpdateTimeEntryDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateTimeEntry extends AbstractRequest
{
    public function __construct(
        private readonly int|TimeEntryData $timeEntry,
        public readonly UpdateTimeEntryDto $update,
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        return '/time_entries/'.($this->timeEntry instanceof TimeEntryData ? $this->timeEntry->id : $this->timeEntry);
    }

    public function parseResponse(ResponseInterface $response): TimeEntryResponse
    {
        $data = Serializer::deserializeArray($response->toArray(), TimeEntryData::class);

        return new TimeEntryResponse($data);
    }
}
