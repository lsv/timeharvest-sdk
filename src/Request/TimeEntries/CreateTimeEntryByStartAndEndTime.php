<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\TimeEntries;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskInfoData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryExternalReference;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryResponse;
use Lsv\TimeharvestSdk\Response\User\UserInfoData;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CreateTimeEntryByStartAndEndTime extends AbstractRequest
{
    use TimeEntryCreatePreQueryTrait;

    public function __construct(
        private readonly int|ProjectInfoData $project,
        private readonly int|TaskInfoData $task,
        private readonly \DateTimeInterface $spentDate,
        private readonly null|int|UserInfoData $user = null,
        public ?string $startedTime = null,
        public ?string $endedTime = null,
        public readonly ?string $notes = null,
        public readonly null|TimeEntryExternalReference $externalReference = null,
    ) {
    }

    protected function preQuery(array &$values): void
    {
        $this->timeEntryPreQuery($values);
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/time_entries';
    }

    public function parseResponse(ResponseInterface $response): TimeEntryResponse
    {
        $data = Serializer::deserializeArray($response->toArray(), TimeEntryData::class);

        return new TimeEntryResponse($data);
    }
}
