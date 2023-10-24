<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\TimeEntries;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryData;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteExternalReferenceFromTimeEntry extends AbstractRequest
{
    public function __construct(
        private readonly int|TimeEntryData $timeEntry,
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        return '/time_entries/'.($this->timeEntry instanceof TimeEntryData ? $this->timeEntry->id : $this->timeEntry).'/external_reference';
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse($response->getStatusCode());
    }
}
