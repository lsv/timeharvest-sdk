<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Dto\User\CreateUserDto;
use Lsv\TimeharvestSdk\Dto\User\UpdateUserDto;
use Lsv\TimeharvestSdk\Request\UsersFactory;
use Lsv\TimeharvestSdk\Response\User\UserData;
use Symfony\Component\HttpClient\Response\MockResponse;

class UsersFactoryTest extends RequestTestCase
{
    private UsersFactory $userFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userFactory = new UsersFactory($this->factory);
    }

    public function testListUsers(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/list_users.json'))
        );
        $this->userFactory->listUsers();
        self::assertSame(
            [],
            $this->getHttpRequestOptions()['query']
        );
        self::assertSame('https://api.harvestapp.com/v2/users', $this->getHttpRequestOptions()['url']);
    }

    public function testMe(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/retrieve_user.json'))
        );
        $this->userFactory->me();
        self::assertStringEndsWith('/users/me', $this->getHttpRequestOptions()['url']);
    }

    public function testRetrieveUser(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/retrieve_user.json'))
        );
        $user = new UserData();
        $user->id = 1234;
        $this->userFactory->retrieveUser($user);
        self::assertStringEndsWith('/users/1234', $this->getHttpRequestOptions()['url']);
    }

    public function testDeleteUser(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse('', ['http_code' => 204])
        );
        $user = new UserData();
        $user->id = 1234;
        $response = $this->userFactory->deleteUser($user);
        self::assertSame(204, $response->statusCode);
        self::assertStringEndsWith('/users/1234', $this->getHttpRequestOptions()['url']);
        self::assertStringEndsWith('DELETE', $this->getHttpRequestOptions()['method']);
    }

    public function testCreateUser(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/retrieve_user.json'))
        );

        $dto = new CreateUserDto('first', 'last', 'email@example.com');
        $this->userFactory->createUser($dto);
        self::assertStringEndsWith('POST', $this->getHttpRequestOptions()['method']);
    }

    public function testUpdateUser(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/retrieve_user.json'))
        );

        $user = new UserData();
        $user->id = 1234;
        $dto = new UpdateUserDto();
        $this->userFactory->updateUser($user, $dto);
        self::assertStringEndsWith('/users/1234', $this->getHttpRequestOptions()['url']);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
    }

    public function testUpdateUserById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/retrieve_user.json'))
        );

        $user = 1;
        $dto = new UpdateUserDto();
        $this->userFactory->updateUser($user, $dto);
        self::assertStringEndsWith('/users/1', $this->getHttpRequestOptions()['url']);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
    }

    public function testArchiveUser(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/retrieve_user.json'))
        );

        $user = new UserData();
        $user->id = 1234;
        $this->userFactory->archiveUser($user);
        self::assertSame(
            ['is_active' => false],
            $this->getHttpRequestOptions()['array']
        );
        self::assertStringEndsWith('/users/1234', $this->getHttpRequestOptions()['url']);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
    }

    public function testArchiveUserById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Users/retrieve_user.json'))
        );

        $user = 1;
        $this->userFactory->archiveUser($user);
        self::assertSame(
            ['is_active' => false],
            $this->getHttpRequestOptions()['array']
        );
        self::assertStringEndsWith('/users/1', $this->getHttpRequestOptions()['url']);
        self::assertStringEndsWith('PATCH', $this->getHttpRequestOptions()['method']);
    }
}
