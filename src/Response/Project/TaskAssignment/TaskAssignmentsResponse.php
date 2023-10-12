<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project\TaskAssignment;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class TaskAssignmentsResponse implements ResponseInterface
{
    /**
     * @param TaskAssignmentData[] $taskAssignments
     */
    public function __construct(
        private MetaResponse $meta,
        private array $taskAssignments
    ) {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return TaskAssignmentData[]
     */
    public function getData(): array
    {
        return $this->taskAssignments;
    }
}
