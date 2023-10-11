<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects;

use Lsv\TimeharvestSdk\Dto\Projects\CreateProjectDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\ProjectResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CreateProject extends AbstractRequest
{
    public function __construct(
        public readonly CreateProjectDto $dto
    ) {
    }

    public function getUri(): string
    {
        return '/projects';
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function parseResponse(ResponseInterface $response): ProjectResponse
    {
        $data = $response->toArray();
        $project = Serializer::deserializeArray($data, ProjectData::class);

        return new ProjectResponse($project);
    }
}
