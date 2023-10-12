<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects;

use Lsv\TimeharvestSdk\Dto\Projects\UserAssignments\CreateUserAssignmentDto;
use Lsv\TimeharvestSdk\Dto\Projects\UserAssignments\UpdateUserAssignmentDto;
use Lsv\TimeharvestSdk\Request\Projects\UserAssignments\CreateUserAssignment;
use Lsv\TimeharvestSdk\Request\Projects\UserAssignments\DeleteUserAssignment;
use Lsv\TimeharvestSdk\Request\Projects\UserAssignments\ListUserAssignments;
use Lsv\TimeharvestSdk\Request\Projects\UserAssignments\ListUserAssignmentsForProject;
use Lsv\TimeharvestSdk\Request\Projects\UserAssignments\RetrieveUserAssignment;
use Lsv\TimeharvestSdk\Request\Projects\UserAssignments\UpdateUserAssignment;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentResponse;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentsResponse;

readonly class UserAssignmentFactory
{
    public function __construct(
        private RequestFactory $factory
    ) {
    }

    public function listUserAssignments(bool $isActive = null, \DateTimeInterface $updatedSince = null, MetaResponse $meta = null): UserAssignmentsResponse
    {
        return $this->factory->request(new ListUserAssignments($isActive, $updatedSince, $meta));
    }

    public function listUserAssignmentsForProject(int|ProjectData $project, bool $isActive = null, \DateTimeInterface $updatedSince = null, MetaResponse $meta = null): UserAssignmentsResponse
    {
        return $this->factory->request(new ListUserAssignmentsForProject($project, $isActive, $updatedSince, $meta));
    }

    public function retrieveUserAssignment(int|ProjectData $project, int|UserAssignmentData $assignment): UserAssignmentResponse
    {
        return $this->factory->request(new RetrieveUserAssignment($project, $assignment));
    }

    public function createUserAssignment(int|ProjectData $project, CreateUserAssignmentDto $dto): UserAssignmentResponse
    {
        return $this->factory->request(new CreateUserAssignment($project, $dto));
    }

    public function updateUserAssignment(int|ProjectData $project, int|UserAssignmentData $assignment, UpdateUserAssignmentDto $dto): UserAssignmentResponse
    {
        return $this->factory->request(new UpdateUserAssignment($project, $assignment, $dto));
    }

    public function deleteUserAssignment(int|ProjectData $project, int|UserAssignmentData $assignment): NullResponse
    {
        return $this->factory->request(new DeleteUserAssignment($project, $assignment));
    }
}
