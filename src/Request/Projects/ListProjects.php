<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Projects;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\ProjectsResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListProjects extends AbstractRequest
{
    public function __construct(
        readonly public ?bool $isActive = null,
        readonly private null|int|ClientInfoData $client = null,
        readonly public ?\DateTimeInterface $updatedSince = null,
        readonly public ?MetaResponse $meta = null
    ) {
    }

    public function getUri(): string
    {
        return 'projects';
    }

    protected function preQuery(array &$values): void
    {
        if (null !== $this->client) {
            $id = $this->client;
            if ($id instanceof ClientInfoData) {
                $id = $id->id;
            }

            $values['client_id'] = $id;
        }
    }

    public function parseResponse(ResponseInterface $response): ProjectsResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $projects = Serializer::deserializeArray($data['projects'], ProjectData::class.'[]');

        return new ProjectsResponse($meta, $projects);
    }
}
