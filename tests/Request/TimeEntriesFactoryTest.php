<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntriesResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Symfony\Component\HttpClient\Response\MockResponse;

class TimeEntriesFactoryTest extends RequestTestCase
{
    public function testListTimeEntries(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/list_time_entries.json'))
        );

        $response = $this->factory->timeEntries()->listTimeEntries();
        self::assertStringEndsWith(
            '/time_entries',
            $this->getHttpRequestOptions()['url']
        );
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertSame([], $this->getHttpRequestOptions()['query']);

        self::assertInstanceOf(TimeEntriesResponse::class, $response);
        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertCount(4, $response->getData());
    }

    public function testListTimeEntriesWithIds(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/list_time_entries.json'))
        );

        $user = 1;
        $client = 1;
        $project = 1;
        $task = 1;
        $from = new \DateTime('2020-01-01');
        $to = new \DateTime('2020-01-31');

        $this->factory->timeEntries()->listTimeEntries(
            $user, $client, $project, $task, from: $from, to: $to
        );
        self::assertSame([
            'user_id' => 1,
            'client_id' => 1,
            'project_id' => 1,
            'task_id' => 1,
            'from' => '2020-01-01',
            'to' => '2020-01-31',
        ], $this->getHttpRequestOptions()['query']);
    }

    public function testListTimeEntriesWithObjects(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/list_time_entries.json'))
        );

        $user = new UserData();
        $user->id = 2;
        $client = new ClientInfoData();
        $client->id = 3;
        $project = new ProjectData();
        $project->id = 4;
        $task = new TaskData();
        $task->id = 5;

        $this->factory->timeEntries()->listTimeEntries($user, $client, $project, $task);
        self::assertSame([
            'user_id' => 2,
            'client_id' => 3,
            'project_id' => 4,
            'task_id' => 5,
        ], $this->getHttpRequestOptions()['query']);
    }
}
