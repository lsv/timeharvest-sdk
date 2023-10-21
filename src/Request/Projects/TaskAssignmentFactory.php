<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects;

use Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments\CreateTaskAssignmentDto;
use Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments\UpdateTaskAssignmentDto;
use Lsv\TimeharvestSdk\Request\Projects\TaskAssignments\CreateTaskAssignment;
use Lsv\TimeharvestSdk\Request\Projects\TaskAssignments\DeleteTaskAssignment;
use Lsv\TimeharvestSdk\Request\Projects\TaskAssignments\ListTaskAssignments;
use Lsv\TimeharvestSdk\Request\Projects\TaskAssignments\ListTaskAssignmentsForProject;
use Lsv\TimeharvestSdk\Request\Projects\TaskAssignments\RetrieveTaskAssignment;
use Lsv\TimeharvestSdk\Request\Projects\TaskAssignments\UpdateTaskAssignment;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentResponse;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentsResponse;

readonly class TaskAssignmentFactory
{
    public function __construct(
        private RequestFactory $factory
    ) {
    }

    public function listTaskAssignments(bool $isActive = null, \DateTimeInterface $updatedSince = null, MetaResponse $meta = null): TaskAssignmentsResponse
    {
        return $this->factory->request(new ListTaskAssignments($isActive, $updatedSince, $meta));
    }

    public function listTaskAssignmentsForProject(int|ProjectInfoData $project, bool $isActive = null, \DateTimeInterface $updatedSince = null, MetaResponse $meta = null): TaskAssignmentsResponse
    {
        return $this->factory->request(new ListTaskAssignmentsForProject($project, $isActive, $updatedSince, $meta));
    }

    public function retrieveTaskAssignment(int|ProjectInfoData $project, int|TaskAssignmentData $assignment): TaskAssignmentResponse
    {
        return $this->factory->request(new RetrieveTaskAssignment($project, $assignment));
    }

    public function createTaskAssignment(int|ProjectInfoData $project, CreateTaskAssignmentDto $dto): TaskAssignmentResponse
    {
        return $this->factory->request(new CreateTaskAssignment($project, $dto));
    }

    public function updateTaskAssignment(int|ProjectInfoData $project, int|TaskAssignmentData $assignment, UpdateTaskAssignmentDto $dto): TaskAssignmentResponse
    {
        return $this->factory->request(new UpdateTaskAssignment($project, $assignment, $dto));
    }

    public function deleteTaskAssignment(int|ProjectInfoData $project, int|TaskAssignmentData $assignment): NullResponse
    {
        return $this->factory->request(new DeleteTaskAssignment($project, $assignment));
    }
}
