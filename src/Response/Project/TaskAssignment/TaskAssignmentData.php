<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project\TaskAssignment;

use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Task\TaskData;

class TaskAssignmentData
{
    public int $id;
    public ProjectData $project;
    public TaskData $task;
    public bool $isActive;
    public ?bool $billable;
    public ?float $hourlyRate;
    public ?float $budget;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;
}
