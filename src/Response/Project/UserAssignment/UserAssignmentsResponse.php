<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project\UserAssignment;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class UserAssignmentsResponse implements ResponseInterface
{
    /**
     * @param UserAssignmentData[] $userAssignments
     */
    public function __construct(
        private MetaResponse $meta,
        private array $userAssignments
    ) {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return UserAssignmentData[]
     */
    public function getData(): array
    {
        return $this->userAssignments;
    }
}
