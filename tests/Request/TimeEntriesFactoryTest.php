<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Dto\TimeEntries\UpdateTimeEntryDto;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntriesResponse;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntryResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdk\Response\User\UserInfoData;
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

    public function testRetrieveTimeEntryById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $timeEntry = 1;
        $response = $this->factory->timeEntries()->retrieveTimeEntry($timeEntry);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries/1',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(TimeEntryResponse::class, $response);
        self::assertNull($response->getMeta());
        self::assertInstanceOf(TimeEntryData::class, $response->getData());
    }

    public function testRetrieveTimeEntryByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $timeEntry = new TimeEntryData();
        $timeEntry->id = 2;
        $response = $this->factory->timeEntries()->retrieveTimeEntry($timeEntry);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries/2',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(TimeEntryResponse::class, $response);
        self::assertNull($response->getMeta());
        self::assertInstanceOf(TimeEntryData::class, $response->getData());
    }

    public function testCreateTimeEntryByDurationByInt(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $project = 1;
        $task = 2;
        $spentDate = new \DateTime('2020-01-01');
        $user = 3;
        $hours = 4;
        $notes = 'notes';

        $response = $this->factory->timeEntries()->createTimeEntryByDuration(
            $project, $task, $spentDate, $user, $hours, $notes
        );

        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries',
            $this->getHttpRequestOptions()['url']
        );
        self::assertSame([
            'hours' => 4.0,
            'notes' => 'notes',
            'project_id' => 1,
            'task_id' => 2,
            'user_id' => 3,
            'spent_date' => '2020-01-01',
        ], $this->getHttpRequestOptions()['array']);

        self::assertInstanceOf(TimeEntryResponse::class, $response);
        self::assertNull($response->getMeta());
        self::assertInstanceOf(TimeEntryData::class, $response->getData());
    }

    public function testCreateTimeEntryByDurationByObjects(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $project = new ProjectInfoData();
        $project->id = 1;
        $task = new TaskData();
        $task->id = 2;
        $spentDate = new \DateTime('2020-01-01');
        $user = new UserInfoData();
        $user->id = 3;
        $hours = 4;
        $notes = 'notes';

        $response = $this->factory->timeEntries()->createTimeEntryByDuration(
            $project, $task, $spentDate, $user, $hours, $notes
        );

        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries',
            $this->getHttpRequestOptions()['url']
        );
        self::assertSame([
            'hours' => 4.0,
            'notes' => 'notes',
            'project_id' => 1,
            'task_id' => 2,
            'user_id' => 3,
            'spent_date' => '2020-01-01',
        ], $this->getHttpRequestOptions()['array']);

        self::assertInstanceOf(TimeEntryResponse::class, $response);
        self::assertNull($response->getMeta());
        self::assertInstanceOf(TimeEntryData::class, $response->getData());
    }

    public function testCreateTimeEntryByStartAndEndTimeByInt(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $project = 1;
        $task = 2;
        $spentDate = new \DateTime('2020-01-01');
        $user = 3;
        $startTime = '09:00';
        $endTime = '12:00';
        $notes = 'notes';

        $response = $this->factory->timeEntries()->createTimeEntryByStartAndEndTime(
            $project, $task, $spentDate, $user, $startTime, $endTime, $notes
        );

        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries',
            $this->getHttpRequestOptions()['url']
        );
        self::assertSame([
            'started_time' => '09:00',
            'ended_time' => '12:00',
            'notes' => 'notes',
            'project_id' => 1,
            'task_id' => 2,
            'user_id' => 3,
            'spent_date' => '2020-01-01',
        ], $this->getHttpRequestOptions()['array']);

        self::assertInstanceOf(TimeEntryResponse::class, $response);
        self::assertNull($response->getMeta());
        self::assertInstanceOf(TimeEntryData::class, $response->getData());
    }

    public function testCreateTimeEntryByStartAndEndTimeByObjects(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $project = new ProjectInfoData();
        $project->id = 1;
        $task = new TaskData();
        $task->id = 2;
        $spentDate = new \DateTime('2020-01-01');
        $user = new UserInfoData();
        $user->id = 3;
        $startTime = '09:00';
        $endTime = '12:00';
        $notes = 'notes';

        $response = $this->factory->timeEntries()->createTimeEntryByStartAndEndTime(
            $project, $task, $spentDate, $user, $startTime, $endTime, $notes
        );

        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries',
            $this->getHttpRequestOptions()['url']
        );
        self::assertSame([
            'started_time' => '09:00',
            'ended_time' => '12:00',
            'notes' => 'notes',
            'project_id' => 1,
            'task_id' => 2,
            'user_id' => 3,
            'spent_date' => '2020-01-01',
        ], $this->getHttpRequestOptions()['array']);

        self::assertInstanceOf(TimeEntryResponse::class, $response);
        self::assertNull($response->getMeta());
        self::assertInstanceOf(TimeEntryData::class, $response->getData());
    }

    public function testUpdateTimeEntry(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $entry = 1;
        $dto = new UpdateTimeEntryDto(1, 1, new \DateTime());
        $response = $this->factory->timeEntries()->updateTimeEntry($entry, $dto);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries/1',
            $this->getHttpRequestOptions()['url']
        );
        self::assertSame([
            'project_id' => 1,
            'task_id' => 1,
            'spent_date' => '2023-10-24',
        ], $this->getHttpRequestOptions()['array']);
        self::assertInstanceOf(TimeEntryResponse::class, $response);
        self::assertNull($response->getMeta());
        self::assertInstanceOf(TimeEntryData::class, $response->getData());
    }

    public function testUpdateTimeEntryByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $project = new ProjectData();
        $project->id = 1;
        $task = new TaskData();
        $task->id = 2;
        $dto = new UpdateTimeEntryDto($project, $task);

        $entry = new TimeEntryData();
        $entry->id = 2;
        $this->factory->timeEntries()->updateTimeEntry($entry, $dto);
        self::assertStringEndsWith(
            '/time_entries/2',
            $this->getHttpRequestOptions()['url']
        );
        self::assertSame([
            'project_id' => 1,
            'task_id' => 2,
        ], $this->getHttpRequestOptions()['array']);
    }

    public function testUpdateTimeEntryByNull(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TimeEntries/retrieve_time_entry.json'))
        );

        $dto = new UpdateTimeEntryDto();
        $this->factory->timeEntries()->updateTimeEntry(1, $dto);
        self::assertSame([], $this->getHttpRequestOptions()['array']);
    }

    public function testDeleteExternalReference(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse('', ['http_code' => 201]));
        $response = $this->factory->timeEntries()->deleteExternalReference(1);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries/1/external_reference',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(NullResponse::class, $response);
    }

    public function testDeleteExternalReferenceByObject(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse('', ['http_code' => 201]));
        $entry = new TimeEntryData();
        $entry->id = 2;
        $response = $this->factory->timeEntries()->deleteExternalReference($entry);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries/2/external_reference',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(NullResponse::class, $response);
    }

    public function testDeleteTimeEntry(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse('', ['http_code' => 201]));
        $response = $this->factory->timeEntries()->deleteTimeEntry(1);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries/1',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(NullResponse::class, $response);
    }

    public function testDeleteTimeEntryByObject(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse('', ['http_code' => 201]));
        $entry = new TimeEntryData();
        $entry->id = 2;
        $response = $this->factory->timeEntries()->deleteTimeEntry($entry);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/time_entries/2',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(NullResponse::class, $response);
    }
}
