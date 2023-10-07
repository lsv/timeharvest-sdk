<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Task;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class TasksResponse implements ResponseInterface
{
    /**
     * @param TaskData[] $tasks
     */
    public function __construct(
        private MetaResponse $meta,
        private array $tasks,
    ) {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return TaskData[]
     */
    public function getData(): array
    {
        return $this->tasks;
    }
}
