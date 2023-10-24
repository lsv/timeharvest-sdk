<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteProject extends AbstractRequest
{
    public function __construct(
        private readonly int|ProjectInfoData $project
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        $id = $this->project;
        if ($id instanceof ProjectInfoData) {
            $id = $id->id;
        }

        return '/projects/'.$id;
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse($response->getStatusCode());
    }
}
