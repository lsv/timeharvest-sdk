<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects;

use Lsv\TimeharvestSdk\Dto\Projects\UpdateProjectDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Project\ProjectResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateProject extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectInfoData $project,
        public readonly UpdateProjectDto $dto
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        $id = $this->project;
        if ($id instanceof ProjectInfoData) {
            $id = $id->id;
        }

        return '/projects/'.$id;
    }

    public function parseResponse(ResponseInterface $response): ProjectResponse
    {
        $data = $response->toArray();
        $project = Serializer::deserializeArray($data, ProjectData::class);

        return new ProjectResponse($project);
    }
}
