<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Tasks;

use Lsv\TimeharvestSdk\Dto\Tasks\CreateTaskDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\Task\TaskResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class CreateTask extends AbstractRequest
{
    public function __construct(
        public readonly CreateTaskDto $dto
    ) {
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return '/tasks';
    }

    public function parseResponse(ResponseInterface $response): TaskResponse
    {
        return new TaskResponse(Serializer::deserializeArray($response->toArray(), TaskData::class));
    }
}
