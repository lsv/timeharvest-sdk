<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\TaskAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentData;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteTaskAssignment extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectData $project,
        private readonly int|TaskAssignmentData $assignment,
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        $project = $this->project;
        if ($project instanceof ProjectData) {
            $project = $project->id;
        }

        $task = $this->assignment;
        if ($task instanceof TaskAssignmentData) {
            $task = $task->id;
        }

        return '/projects/'.$project.'/task_assignments/'.$task;
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse($response->getStatusCode());
    }
}
