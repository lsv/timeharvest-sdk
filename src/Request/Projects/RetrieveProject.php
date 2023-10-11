<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\ProjectResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RetrieveProject extends AbstractRequest
{
    public function __construct(
        readonly private int|ProjectData $project
    ) {
    }

    public function getUri(): string
    {
        $id = $this->project;
        if ($id instanceof ProjectData) {
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
