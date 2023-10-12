<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project\UserAssignment;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class UserAssignmentResponse implements ResponseInterface
{
    public function __construct(
        private UserAssignmentData $userAssignment
    ) {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): UserAssignmentData
    {
        return $this->userAssignment;
    }
}
