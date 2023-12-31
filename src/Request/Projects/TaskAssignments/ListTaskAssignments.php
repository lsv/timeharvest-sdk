<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\TaskAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentsResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListTaskAssignments extends AbstractRequest
{
    public function __construct(
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        public readonly ?MetaResponse $meta = null
    ) {
    }

    public function getUri(): string
    {
        return '/task_assignments';
    }

    public function parseResponse(ResponseInterface $response): TaskAssignmentsResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $assignments = Serializer::deserializeArray($data['task_assignments'], TaskAssignmentData::class.'[]');

        return new TaskAssignmentsResponse($meta, $assignments);
    }
}
