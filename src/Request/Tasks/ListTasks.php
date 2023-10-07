<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Tasks;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\Task\TasksResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ListTasks extends AbstractRequest
{
    public function __construct(
        public readonly ?bool $isActive = null,
        public readonly ?\DateTimeInterface $updatedSince = null,
        public readonly ?MetaResponse $meta = null,
    ) {
    }

    public function getUri(): string
    {
        return '/tasks';
    }

    public function parseResponse(ResponseInterface $response): TasksResponse
    {
        $data = $response->toArray();
        $meta = Serializer::deserializeArray($data, MetaResponse::class);
        $tasks = Serializer::deserializeArray($data['tasks'], TaskData::class.'[]');

        return new TasksResponse($meta, $tasks);
    }
}
