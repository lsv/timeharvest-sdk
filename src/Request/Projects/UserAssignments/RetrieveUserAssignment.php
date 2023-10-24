<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\UserAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentResponse;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryUserAssignment;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RetrieveUserAssignment extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectInfoData $project,
        private readonly int|UserAssignmentData|TimeEntryUserAssignment $assignment
    ) {
    }

    public function getUri(): string
    {
        $project = $this->project;
        if ($project instanceof ProjectInfoData) {
            $project = $project->id;
        }

        $task = $this->assignment;
        if ($task instanceof UserAssignmentData || $task instanceof TimeEntryUserAssignment) {
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
