<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\UserAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentsResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListUserAssignmentsForProject extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectInfoData $project,
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        public readonly ?MetaResponse $meta = null
    ) {
    }

    public function getUri(): string
    {
        $project = $this->project;
        if ($project instanceof ProjectInfoData) {
            $project = $project->id;
        }

        return '/projects/'.$project.'/user_assignments';
    }

    public function parseResponse(ResponseInterface $response): UserAssignmentsResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $assignments = Serializer::deserializeArray($data['user_assignments'], UserAssignmentData::class.'[]');

        return new UserAssignmentsResponse($meta, $assignments);
    }
}
