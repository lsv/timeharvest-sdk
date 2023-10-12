<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments;

use Lsv\TimeharvestSdk\Dto\DtoInterface;
use Lsv\TimeharvestSdk\Response\Task\TaskData;

readonly class CreateTaskAssignmentDto implements DtoInterface
{
    public function __construct(
        public int|TaskData $taskId,
        public ?bool $isActive = null,
        public ?bool $billable = null,
        public ?float $hourlyRate = null,
        public ?float $budget = null,
    ) {
    }

    public function getTaskId(): int
    {
        if ($this->taskId instanceof TaskData) {
            return $this->taskId->id;
        }

        return $this->taskId;
    }
}
