<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Task;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class TaskResponse implements ResponseInterface
{
    public function __construct(
        private TaskData $task,
    ) {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): TaskData
    {
        return $this->task;
    }
}
