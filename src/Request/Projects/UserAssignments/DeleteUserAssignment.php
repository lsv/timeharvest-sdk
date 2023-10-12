<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\UserAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteUserAssignment extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectData $project,
        private readonly int|UserAssignmentData $assignment,
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
        if ($task instanceof UserAssignmentData) {
            $task = $task->id;
        }

        return '/projects/'.$project.'/user_assignments/'.$task;
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse($response->getStatusCode());
    }
}
