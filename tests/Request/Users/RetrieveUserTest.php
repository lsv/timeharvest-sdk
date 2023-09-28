<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Users;

use Lsv\TimeharvestSdk\Request\Users\RetrieveUser;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class RetrieveUserTest extends RequestTestCase
{
    public function testRetrieveUser(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_user.json'))
        );

        $user = 1;
        $request = new RetrieveUser($user);
        $response = $this->factory->request($request);

        self::assertStringEndsWith('/users/1', $this->getHttpRequestOptions()['url']);

        self::assertNull($response->getMeta());
        $user = $response->getData();
        self::assertSame(3230547, $user->id);
        self::assertSame('Jim', $user->firstName);
        self::assertSame('Allen', $user->lastName);
    }
}
