<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project\TaskAssignment;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class TaskAssignmentResponse implements ResponseInterface
{
    public function __construct(
        private TaskAssignmentData $taskAssignment
    ) {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): TaskAssignmentData
    {
        return $this->taskAssignment;
    }
}
