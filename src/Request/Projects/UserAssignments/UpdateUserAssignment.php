<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\UserAssignments;

use Lsv\TimeharvestSdk\Dto\Projects\UserAssignments\UpdateUserAssignmentDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateUserAssignment extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectData $project,
        private readonly int|UserAssignmentData $assignment,
        public readonly UpdateUserAssignmentDto $dto
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
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

    public function parseResponse(ResponseInterface $response): UserAssignmentResponse
    {
        $data = $response->toArray();
        $assignment = Serializer::deserializeArray($data, UserAssignmentData::class);

        return new UserAssignmentResponse($assignment);
    }
}
