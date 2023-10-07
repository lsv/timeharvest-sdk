<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Dto\Tasks\CreateTaskDto;
use Lsv\TimeharvestSdk\Dto\Tasks\UpdateTaskDto;
use Lsv\TimeharvestSdk\Request\Tasks\CreateTask;
use Lsv\TimeharvestSdk\Request\Tasks\ListTasks;
use Lsv\TimeharvestSdk\Request\Tasks\RetrieveTask;
use Lsv\TimeharvestSdk\Request\Tasks\UpdateTask;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\Task\TaskResponse;
use Lsv\TimeharvestSdk\Response\Task\TasksResponse;

readonly class TasksFactory
{
    public function __construct(
        private RequestFactory $factory
    ) {
    }

    public function listTasks(bool $isActive = null, \DateTimeInterface $updatedSince = null, MetaResponse $meta = null): TasksResponse
    {
        return $this->factory->request(new ListTasks($isActive, $updatedSince, $meta));
    }

    public function retrieveTask(int|TaskData $task): TaskResponse
    {
        return $this->factory->request(new RetrieveTask($task));
    }

    public function createTask(CreateTaskDto $dto): TaskResponse
    {
        return $this->factory->request(new CreateTask($dto));
    }

    public function updateTask(int|TaskData $task, UpdateTaskDto $dto): TaskResponse
    {
        return $this->factory->request(new UpdateTask($task, $dto));
    }
}
