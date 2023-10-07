<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\Task\TaskResponse;
use Lsv\TimeharvestSdk\Response\Task\TasksResponse;
use Symfony\Component\HttpClient\Response\MockResponse;

class TasksFactoryTest extends RequestTestCase
{
    public function testListTasks(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Tasks/list_tasks.json'))
        );

        $response = $this->factory->tasks()->listTasks();
        self::assertStringEndsWith(
            '/tasks',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(TasksResponse::class, $response);
        self::assertCount(5, $response->getData());
    }

    public function testRetrieveTask(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Tasks/retrieve_task.json'))
        );

        $response = $this->factory->tasks()->retrieveTask(1);
        self::assertStringEndsWith(
            '/tasks/1',
            $this->getHttpRequestOptions()['url']
        );
        self::assertSame(8083800, $response->getData()->id);
        self::assertNull($response->getMeta());
    }

    public function testRetrieveTaskByTask(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Tasks/retrieve_task.json'))
        );

        $task = new TaskData();
        $task->id = 2;
        $response = $this->factory->tasks()->retrieveTask($task);
        self::assertStringEndsWith(
            '/tasks/2',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(TaskResponse::class, $response);
    }

    public function testCreateTask(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Tasks/retrieve_task.json'))
        );

        $dto = new \Lsv\TimeharvestSdk\Dto\Tasks\CreateTaskDto('name');
        $response = $this->factory->tasks()->createTask($dto);
        self::assertInstanceOf(TaskData::class, $response->getData());
        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
    }

    public function testUpdateTask(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Tasks/retrieve_task.json'))
        );

        $task = 1;
        $dto = new \Lsv\TimeharvestSdk\Dto\Tasks\UpdateTaskDto();
        $response = $this->factory->tasks()->updateTask($task, $dto);
        self::assertStringEndsWith(
            '/tasks/1',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(TaskData::class, $response->getData());
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
    }

    public function testUpdateTaskByTask(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Tasks/retrieve_task.json'))
        );

        $task = new TaskData();
        $task->id = 2;
        $dto = new \Lsv\TimeharvestSdk\Dto\Tasks\UpdateTaskDto();
        $response = $this->factory->tasks()->updateTask($task, $dto);
        self::assertStringEndsWith(
            '/tasks/2',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(TaskData::class, $response->getData());
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
    }

    public function testDeleteTask(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 201])
        );

        $task = 1;
        $this->factory->tasks()->deleteTask($task);
        self::assertStringEndsWith(
            '/tasks/1',
            $this->getHttpRequestOptions()['url']
        );
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
    }

    public function testDeleteTaskByTask(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 201])
        );

        $task = new TaskData();
        $task->id = 2;
        $this->factory->tasks()->deleteTask($task);
        self::assertStringEndsWith(
            '/tasks/2',
            $this->getHttpRequestOptions()['url']
        );
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
    }
}
