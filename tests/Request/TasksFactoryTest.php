<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

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
        self::assertCount(5, $response->tasks);
    }
}
