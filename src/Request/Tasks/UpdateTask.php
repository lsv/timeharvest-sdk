<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Tasks;

use Lsv\TimeharvestSdk\Dto\Tasks\UpdateTaskDto;
use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\Task\TaskResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class UpdateTask extends AbstractRequest
{
    public function __construct(
        private int|TaskData $task,
        public readonly UpdateTaskDto $dto
    ) {
    }

    public function getMethod(): string
    {
        return 'PATCH';
    }

    public function getUri(): string
    {
        $id = $this->task instanceof TaskData ? $this->task->id : $this->task;

        return '/tasks/'.$id;
    }

    public function parseResponse(ResponseInterface $response): TaskResponse
    {
        return new TaskResponse(Serializer::deserializeArray($response->toArray(), TaskData::class));
    }
}
