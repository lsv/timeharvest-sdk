<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\TimeEntries;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RetrieveTimeEntry extends AbstractRequest
{
    public function __construct(
        private readonly int|TimeEntryData $timeEntryId
    ) {
    }

    public function getUri(): string
    {
        $id = $this->timeEntryId;
        if ($id instanceof TimeEntryData) {
            $id = $id->id;
        }

        return sprintf('/time_entries/%s', $id);
    }

    public function parseResponse(ResponseInterface $response): TimeEntryResponse
    {
        $data = Serializer::deserializeArray($response->toArray(), TimeEntryData::class);

        return new TimeEntryResponse($data);
    }
}
