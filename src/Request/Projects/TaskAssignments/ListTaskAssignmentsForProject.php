<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\TaskAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentsResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListTaskAssignmentsForProject extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectData $project,
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        public readonly ?MetaResponse $meta = null
    ) {
    }

    public function getUri(): string
    {
        $project = $this->project;
        if ($project instanceof ProjectData) {
            $project = $project->id;
        }

        return '/projects/'.$project.'/task_assignments';
    }

    public function parseResponse(ResponseInterface $response): TaskAssignmentsResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $assignments = Serializer::deserializeArray($data['task_assignments'], TaskAssignmentData::class.'[]');

        return new TaskAssignmentsResponse($meta, $assignments);
    }
}
