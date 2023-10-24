<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\TimeEntries;

use Lsv\TimeharvestSdk\Dto\DtoInterface;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskInfoData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryExternalReference;

readonly class UpdateTimeEntryDto implements DtoInterface
{
    public function __construct(
        public null|int|ProjectInfoData $projectId = null,
        public null|int|TaskInfoData $taskId = null,
        public null|\DateTimeInterface $spentDate = null,
        public null|string $startedTime = null,
        public null|string $endedTime = null,
        public null|float $hours = null,
        public null|string $notes = null,
        public ?TimeEntryExternalReference $externalReference = null,
    ) {
    }

    public function getProjectId(): ?int
    {
        if (!$this->projectId) {
            return null;
        }

        return $this->projectId instanceof ProjectInfoData ? $this->projectId->id : $this->projectId;
    }

    public function getTaskId(): ?int
    {
        if (!$this->taskId) {
            return null;
        }

        return $this->taskId instanceof TaskInfoData ? $this->taskId->id : $this->taskId;
    }

    public function getSpentDate(): ?string
    {
        return $this->spentDate?->format('Y-m-d');
    }
}
