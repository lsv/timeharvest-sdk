<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Tasks;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Task\TasksResponse;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class ListTasksTest extends RequestTestCase
{
    public function testCanGetTasks(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_tasks.json'))
        );

        $updatedSince = new \DateTime('2017-06-26');
        $response = $this->factory->tasks()->listTasks(true, $updatedSince);
        self::assertSame(
            ['is_active' => true, 'updated_since' => $updatedSince->format('c')],
            $this->getHttpRequestOptions()['query']
        );

        self::assertInstanceOf(TasksResponse::class, $response);
        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertCount(5, $response->getData());
        $task = $response->getData()[0];

        self::assertSame(8083800, $task->id);
        self::assertSame('Business Development', $task->name);
        self::assertFalse($task->billableByDefault);
        self::assertSame(0.0, $task->defaultHourlyRate);
        self::assertFalse($task->isDefault);
        self::assertTrue($task->isActive);
        self::assertSame('2017-06-26', $task->createdAt->format('Y-m-d'));
        self::assertSame('2017-06-26', $task->updatedAt->format('Y-m-d'));
    }
}
