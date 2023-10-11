<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Dto\Projects\CreateProjectDto;
use Lsv\TimeharvestSdk\Dto\Projects\UpdateProjectDto;
use Lsv\TimeharvestSdk\Request\Projects\CreateProject;
use Lsv\TimeharvestSdk\Request\Projects\DeleteProject;
use Lsv\TimeharvestSdk\Request\Projects\ListProjects;
use Lsv\TimeharvestSdk\Request\Projects\RetrieveProject;
use Lsv\TimeharvestSdk\Request\Projects\UpdateProject;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\ProjectResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectsResponse;

readonly class ProjectsFactory
{
    public function __construct(
        private RequestFactory $factory
    ) {
    }

    public function listProjects(bool $isActive = null, int|ClientInfoData $client = null, \DateTimeInterface $updatedSince = null, MetaResponse $meta = null): ProjectsResponse
    {
        return $this->factory->request(new ListProjects($isActive, $client, $updatedSince, $meta));
    }

    public function retrieveProject(int|ProjectData $project): ProjectResponse
    {
        return $this->factory->request(new RetrieveProject($project));
    }

    public function createProject(CreateProjectDto $dto): ProjectResponse
    {
        return $this->factory->request(new CreateProject($dto));
    }

    public function updateProject(int|ProjectData $project, UpdateProjectDto $dto): ProjectResponse
    {
        return $this->factory->request(new UpdateProject($project, $dto));
    }

    public function deleteProject(int|ProjectData $project): NullResponse
    {
        return $this->factory->request(new DeleteProject($project));
    }
}
