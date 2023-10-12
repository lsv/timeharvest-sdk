<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Projects;

use Lsv\TimeharvestSdk\Dto\Projects\UserAssignments\CreateUserAssignmentDto;
use Lsv\TimeharvestSdk\Dto\Projects\UserAssignments\UpdateUserAssignmentDto;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\NullResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentResponse;
use Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentsResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Lsv\TimeharvestSdkTest\RequestFactoryTest;
use Symfony\Component\HttpClient\Response\MockResponse;

class UserAssignmentFactoryTest extends RequestFactoryTest
{
    public function testListUserAssignments(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/list_user_assignments.json'))
        );

        $response = $this->factory->projects()->userAssignments()->listUserAssignments();
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/user_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertInstanceOf(UserAssignmentsResponse::class, $response);
        self::assertCount(6, $response->getData());
    }

    public function testListUserAssignmentsForProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/list_user_assignments.json'))
        );

        $project = 1;
        $response = $this->factory->projects()->userAssignments()->listUserAssignmentsForProject($project);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/user_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertInstanceOf(UserAssignmentsResponse::class, $response);
        self::assertCount(6, $response->getData());
    }

    public function testListUserAssignmentsForProjectByProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/list_user_assignments.json'))
        );

        $project = new ProjectData();
        $project->id = 2;
        $response = $this->factory->projects()->userAssignments()->listUserAssignmentsForProject($project);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/2/user_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertInstanceOf(UserAssignmentsResponse::class, $response);
        self::assertCount(6, $response->getData());
    }

    public function testRetrieveUserAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/retrieve_user_assignment.json'))
        );

        $project = 1;
        $user = 2;
        $response = $this->factory->projects()->userAssignments()->retrieveUserAssignment($project, $user);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/user_assignments/2',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(UserAssignmentResponse::class, $response);
        self::assertInstanceOf(UserAssignmentData::class, $response->getData());
    }

    public function testRetrieveUserAssignmentByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/retrieve_user_assignment.json'))
        );

        $project = new ProjectData();
        $project->id = 22;
        $user = new UserAssignmentData();
        $user->id = 33;
        $response = $this->factory->projects()->userAssignments()->retrieveUserAssignment($project, $user);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/user_assignments/33',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(UserAssignmentResponse::class, $response);
        self::assertInstanceOf(UserAssignmentData::class, $response->getData());
    }

    public function testCreateTaskAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/retrieve_user_assignment.json'))
        );

        $project = 1;
        $user = new UserData();
        $user->id = 22;
        $dto = new CreateUserAssignmentDto($user);

        $response = $this->factory->projects()->userAssignments()->createUserAssignment($project, $dto);
        self::assertSame([
            'user_id' => 22,
        ], $this->getHttpRequestOptions()['array']);

        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/user_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(UserAssignmentResponse::class, $response);
        self::assertInstanceOf(UserAssignmentData::class, $response->getData());
    }

    public function testCreateUserAssignmentByProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/retrieve_user_assignment.json'))
        );

        $project = new ProjectData();
        $project->id = 22;
        $dto = new CreateUserAssignmentDto(1);

        $response = $this->factory->projects()->userAssignments()->createUserAssignment($project, $dto);
        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/user_assignments',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(UserAssignmentResponse::class, $response);
        self::assertInstanceOf(UserAssignmentData::class, $response->getData());
    }

    public function testUpdateUserAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/retrieve_user_assignment.json'))
        );

        $project = 1;
        $user = 2;
        $dto = new UpdateUserAssignmentDto();

        $response = $this->factory->projects()->userAssignments()->updateUserAssignment($project, $user, $dto);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1/user_assignments/2',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(UserAssignmentResponse::class, $response);
        self::assertInstanceOf(UserAssignmentData::class, $response->getData());
    }

    public function testUpdateUserAssignmentByObject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/UserAssignments/retrieve_user_assignment.json'))
        );

        $project = new ProjectData();
        $project->id = 22;
        $user = new UserAssignmentData();
        $user->id = 33;
        $dto = new UpdateUserAssignmentDto();

        $response = $this->factory->projects()->userAssignments()->updateUserAssignment($project, $user, $dto);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/user_assignments/33',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(UserAssignmentResponse::class, $response);
        self::assertInstanceOf(UserAssignmentData::class, $response->getData());
    }

    public function testDeleteUserAssignment(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 201])
        );

        $project = 22;
        $user = 33;

        $response = $this->factory->projects()->userAssignments()->deleteUserAssignment($project, $user);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/22/user_assignments/33',
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
        $user = new UserAssignmentData();
        $user->id = 2100;

        $response = $this->factory->projects()->userAssignments()->deleteUserAssignment($project, $user);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/2055/user_assignments/2100',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(NullResponse::class, $response);
    }
}
