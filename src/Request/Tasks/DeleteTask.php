<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request\Tasks;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DeleteTask extends AbstractRequest
{
    public function __construct(
        private readonly int|TaskData $task
    ) {
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getUri(): string
    {
        $id = $this->task instanceof TaskData ? $this->task->id : $this->task;

        return 'tasks/'.$id;
    }

    public function parseResponse(ResponseInterface $response): NullResponse
    {
        return new NullResponse($response->getStatusCode());
    }
}
