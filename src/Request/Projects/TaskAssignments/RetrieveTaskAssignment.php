<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\TaskAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RetrieveTaskAssignment extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectInfoData $project,
        private readonly int|TaskAssignmentData $assignment
    ) {
    }

    public function getUri(): string
    {
        $project = $this->project;
        if ($project instanceof ProjectInfoData) {
            $project = $project->id;
        }

        $task = $this->assignment;
        if ($task instanceof TaskAssignmentData) {
            $task = $task->id;
        }

        return '/projects/'.$project.'/task_assignments/'.$task;
    }

    public function parseResponse(ResponseInterface $response): TaskAssignmentResponse
    {
        $data = $response->toArray();
        $assignment = Serializer::deserializeArray($data, TaskAssignmentData::class);

        return new TaskAssignmentResponse($assignment);
    }
}
