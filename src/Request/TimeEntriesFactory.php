<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Dto\TimeEntries\UpdateTimeEntryDto;
use Lsv\TimeharvestSdk\Request\TimeEntries\CreateTimeEntryByDuration;
use Lsv\TimeharvestSdk\Request\TimeEntries\CreateTimeEntryByStartAndEndTime;
use Lsv\TimeharvestSdk\Request\TimeEntries\DeleteExternalReferenceFromTimeEntry;
use Lsv\TimeharvestSdk\Request\TimeEntries\DeleteTimeEntry;
use Lsv\TimeharvestSdk\Request\TimeEntries\ListTimeEntries;
use Lsv\TimeharvestSdk\Request\TimeEntries\RetrieveTimeEntry;
use Lsv\TimeharvestSdk\Request\TimeEntries\UpdateTimeEntry;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\Task\TaskInfoData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntriesResponse;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryExternalReference;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UserInfoData;

readonly class TimeEntriesFactory
{
    public function __construct(
        private RequestFactory $factory
    ) {
    }

    public function listTimeEntries(
        UserData|int $user = null,
        ClientInfoData|int $client = null,
        ProjectInfoData|int $project = null,
        TaskData|int $task = null,
        string $externalReferenceId = null,
        bool $isBilled = null,
        bool $isRunning = null,
        \DateTimeInterface $updatedSince = null,
        \DateTimeInterface $from = null,
        \DateTimeInterface $to = null,
        MetaResponse $meta = null,
    ): TimeEntriesResponse {
        return $this->factory->request(new ListTimeEntries(
            $user,
            $client,
            $project,
            $task,
            $externalReferenceId,
            $isBilled,
            $isRunning,
            $updatedSince,
            $from,
            $to,
            $meta
        ));
    }

    public function retrieveTimeEntry(int|TimeEntryData $timeEntryData): TimeEntryResponse
    {
        return $this->factory->request(new RetrieveTimeEntry($timeEntryData));
    }

    public function createTimeEntryByDuration(
        int|ProjectInfoData $project,
        int|TaskInfoData $task,
        \DateTimeInterface $spentDate,
        int|UserInfoData $user = null,
        float $hours = null,
        string $notes = null,
        TimeEntryExternalReference $externalReference = null,
    ): TimeEntryResponse {
        return $this->factory->request(new CreateTimeEntryByDuration($project, $task, $spentDate, $user, $hours, $notes, $externalReference));
    }

    public function createTimeEntryByStartAndEndTime(
        int|ProjectInfoData $project,
        int|TaskInfoData $task,
        \DateTimeInterface $spentDate,
        int|UserInfoData $user = null,
        string $startedTime = null,
        string $endedTime = null,
        string $notes = null,
        TimeEntryExternalReference $externalReference = null,
    ): TimeEntryResponse {
        return $this->factory->request(new CreateTimeEntryByStartAndEndTime($project, $task, $spentDate, $user, $startedTime, $endedTime, $notes, $externalReference));
    }

    public function updateTimeEntry(
        int|TimeEntryData $timeEntry,
        UpdateTimeEntryDto $updateTimeEntry,
    ): TimeEntryResponse {
        return $this->factory->request(new UpdateTimeEntry($timeEntry, $updateTimeEntry));
    }

    public function deleteExternalReference(int|TimeEntryData $timeEntry): NullResponse
    {
        return $this->factory->request(new DeleteExternalReferenceFromTimeEntry($timeEntry));
    }

    public function deleteTimeEntry(int|TimeEntryData $timeEntry): NullResponse
    {
        return $this->factory->request(new DeleteTimeEntry($timeEntry));
    }
}
