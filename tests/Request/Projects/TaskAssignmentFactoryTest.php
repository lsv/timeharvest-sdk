<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Projects;

use Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments\CreateTaskAssignmentDto;
use Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments\UpdateTaskAssignmentDto;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentResponse;
use Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentsResponse;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdkTest\RequestFactoryTest;
use Symfony\Component\HttpClient\Response\MockResponse;

class TaskAssignmentFactoryTest extends RequestFactoryTest
{
    public function testListTaskAssignments(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/list_task_assignments.json'))
        );

        $response = $this->factory->projects()->taskAssignments()->listTaskAssignments();
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/task_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertInstanceOf(TaskAssignmentsResponse::class, $response);
        self::assertCount(12, $response->getData());
    }

    public function testListTaskAssignmentsForProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/list_task_assignments.json'))
        );

        $project = 1;
        $response = $this->factory->projects()->taskAssignments()->listTaskAssignmentsForProject($project);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/task_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertInstanceOf(TaskAssignmentsResponse::class, $response);
        self::assertCount(12, $response->getData());
    }

    public function testListTaskAssignmentsForProjectByProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/list_task_assignments.json'))
        );

        $project = new ProjectData();
        $project->id = 2;
        $response = $this->factory->projects()->taskAssignments()->listTaskAssignmentsForProject($project);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/2/task_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertInstanceOf(TaskAssignmentsResponse::class, $response);
        self::assertCount(12, $response->getData());
    }

    public function testRetrieveTaskAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/retrieve_task_assignment.json'))
        );

        $project = 1;
        $task = 2;
        $response = $this->factory->projects()->taskAssignments()->retrieveTaskAssignment($project, $task);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/task_assignments/2',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(TaskAssignmentResponse::class, $response);
        self::assertInstanceOf(TaskAssignmentData::class, $response->getData());
    }

    public function testRetrieveTaskAssignmentByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/retrieve_task_assignment.json'))
        );

        $project = new ProjectData();
        $project->id = 22;
        $task = new TaskAssignmentData();
        $task->id = 33;
        $response = $this->factory->projects()->taskAssignments()->retrieveTaskAssignment($project, $task);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/task_assignments/33',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(TaskAssignmentResponse::class, $response);
        self::assertInstanceOf(TaskAssignmentData::class, $response->getData());
    }

    public function testCreateTaskAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/retrieve_task_assignment.json'))
        );

        $project = 1;
        $task = new TaskData();
        $task->id = 22;
        $dto = new CreateTaskAssignmentDto($task);

        $response = $this->factory->projects()->taskAssignments()->createTaskAssignment($project, $dto);
        self::assertSame([
            'task_id' => 22,
        ], $this->getHttpRequestOptions()['array']);

        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/task_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(TaskAssignmentResponse::class, $response);
        self::assertInstanceOf(TaskAssignmentData::class, $response->getData());
    }

    public function testCreateTaskAssignmentByProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/retrieve_task_assignment.json'))
        );

        $project = new ProjectData();
        $project->id = 22;
        $dto = new CreateTaskAssignmentDto(1);

        $response = $this->factory->projects()->taskAssignments()->createTaskAssignment($project, $dto);
        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/task_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(TaskAssignmentResponse::class, $response);
        self::assertInstanceOf(TaskAssignmentData::class, $response->getData());
    }

    public function testUpdateTaskAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/retrieve_task_assignment.json'))
        );

        $project = 1;
        $task = 2;
        $dto = new UpdateTaskAssignmentDto();

        $response = $this->factory->projects()->taskAssignments()->updateTaskAssignment($project, $task, $dto);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/task_assignments/2',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(TaskAssignmentResponse::class, $response);
        self::assertInstanceOf(TaskAssignmentData::class, $response->getData());
    }

    public function testUpdateTaskAssignmentByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/TaskAssignments/retrieve_task_assignment.json'))
        );

        $project = new ProjectData();
        $project->id = 22;
        $task = new TaskAssignmentData();
        $task->id = 33;
        $dto = new UpdateTaskAssignmentDto();

        $response = $this->factory->projects()->taskAssignments()->updateTaskAssignment($project, $task, $dto);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/task_assignments/33',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(TaskAssignmentResponse::class, $response);
        self::assertInstanceOf(TaskAssignmentData::class, $response->getData());
    }

    public function testDeleteTaskAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 201])
        );

        $project = 22;
        $task = 33;

        $response = $this->factory->projects()->taskAssignments()->deleteTaskAssignment($project, $task);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/task_assignments/33',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(NullResponse::class, $response);
    }

    public function testDeleteTaskAssignmentByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 201])
        );

        $project = new ProjectData();
        $project->id = 2055;
        $task = new TaskAssignmentData();
        $task->id = 2100;

        $response = $this->factory->projects()->taskAssignments()->deleteTaskAssignment($project, $task);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/2055/task_assignments/2100',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(NullResponse::class, $response);
    }
}
