<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Dto\Projects\CreateProjectDto;
use Lsv\TimeharvestSdk\Dto\Projects\UpdateProjectDto;
use Lsv\TimeharvestSdk\Request\Projects\TaskAssignmentFactory;
use Lsv\TimeharvestSdk\Request\Projects\UserAssignmentFactory;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\Project\ProjectResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectsResponse;
use Lsv\TimeharvestSdkTest\RequestFactoryTest;
use Symfony\Component\HttpClient\Response\MockResponse;

class ProjectsFactoryTest extends RequestFactoryTest
{
    public function testListProjects(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/list_projects.json'))
        );
        $response = $this->factory->projects()->listProjects();
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(ProjectsResponse::class, $response);
        self::assertCount(2, $response->getData());
    }

    public function testListProjectsByClient(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/list_projects.json'))
        );
        $client = 1;
        $response = $this->factory->projects()->listProjects(client: $client);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects?client_id=1',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(ProjectsResponse::class, $response);
        self::assertCount(2, $response->getData());
    }

    public function testListProjectsByClientData(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/list_projects.json'))
        );
        $client = new ClientInfoData();
        $client->id = 2;
        $response = $this->factory->projects()->listProjects(client: $client);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects?client_id=2',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(ProjectsResponse::class, $response);
        self::assertCount(2, $response->getData());
    }

    public function testRetrieveProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/retrieve_project.json'))
        );
        $project = 1;
        $response = $this->factory->projects()->retrieveProject($project);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1',
            $this->getHttpRequestOptions()['url']
        );

        self::assertInstanceOf(ProjectResponse::class, $response);
        self::assertInstanceOf(ProjectData::class, $response->getData());
    }

    public function testRetrieveProjectByProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/retrieve_project.json'))
        );
        $project = new ProjectData();
        $project->id = 2;
        $this->factory->projects()->retrieveProject($project);
        self::assertStringEndsWith('GET', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/2',
            $this->getHttpRequestOptions()['url']
        );
    }

    public function testCreateProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/retrieve_project.json'))
        );
        $dto = new CreateProjectDto(1, 'name', true, 'bill', 'budget');
        $response = $this->factory->projects()->createProject($dto);
        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(ProjectResponse::class, $response);
        self::assertInstanceOf(ProjectData::class, $response->getData());
    }

    public function testUpdateProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/retrieve_project.json'))
        );
        $project = 1;
        $dto = new UpdateProjectDto();
        $response = $this->factory->projects()->updateProject($project, $dto);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1',
            $this->getHttpRequestOptions()['url']
        );
        self::assertInstanceOf(ProjectResponse::class, $response);
        self::assertInstanceOf(ProjectData::class, $response->getData());
    }

    public function testUpdateProjectByProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Projects/retrieve_project.json'))
        );
        $project = new ProjectData();
        $project->id = 2;
        $dto = new UpdateProjectDto();
        $this->factory->projects()->updateProject($project, $dto);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/2',
            $this->getHttpRequestOptions()['url']
        );
    }

    public function testDeleteProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 201])
        );
        $project = 1;
        $this->factory->projects()->deleteProject($project);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/1',
            $this->getHttpRequestOptions()['url']
        );
    }

    public function testDeleteProjectByProject(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 201])
        );
        $project = new ProjectData();
        $project->id = 2;
        $this->factory->projects()->deleteProject($project);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
        self::assertStringEndsWith(
            '/projects/2',
            $this->getHttpRequestOptions()['url']
        );
    }

    public function testTaskAssignments(): void
    {
        self::assertInstanceOf(TaskAssignmentFactory::class, $this->factory->projects()->taskAssignments());
    }

    public function testUserAssignments(): void
    {
        self::assertInstanceOf(UserAssignmentFactory::class, $this->factory->projects()->userAssignments());
    }
}
