<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Tasks;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\Task\TaskInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskResponse;
use Lsv\TimeharvestSdk\Serializer;
use Symfony\Contracts\HttpClient\ResponseInterface;

class RetrieveTask extends AbstractRequest
{
    public function __construct(
        private readonly int|TaskInfoData $task
    ) {
    }

    public function getUri(): string
    {
        $id = $this->task instanceof TaskInfoData ? $this->task->id : $this->task;

        return 'tasks/'.$id;
    }

    public function parseResponse(ResponseInterface $response): TaskResponse
    {
        $data = $response->toArray();
        $task = Serializer::deserializeArray($data, TaskData::class);

        return new TaskResponse($task);
    }
}
