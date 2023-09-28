<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\Request\UsersFactory;
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
            ['page' => 1, 'per_page' => 2000],
            $this->getHttpRequestOptions()['query']
        );
    }
}
