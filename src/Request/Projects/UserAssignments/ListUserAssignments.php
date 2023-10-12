<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects\UserAssignments;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentsResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListUserAssignments extends AbstractRequest
{
    public function __construct(
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        public readonly ?MetaResponse $meta = null
    ) {
    }

    public function getUri(): string
    {
        return '/user_assignments';
    }

    public function parseResponse(ResponseInterface $response): UserAssignmentsResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $assignments = Serializer::deserializeArray($data['user_assignments'], UserAssignmentData::class.'[]');

        return new UserAssignmentsResponse($meta, $assignments);
    }
}
