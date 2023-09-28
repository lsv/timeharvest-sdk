<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Users;

use Lsv\TimeharvestSdk\Request\Users\ListUsers;
use Lsv\TimeharvestSdk\Response\User\UsersResponse;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class ListUsersTest extends RequestTestCase
{
    public function testListUsers(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_users.json'))
        );

        $request = new ListUsers();
        /** @var UsersResponse $response */
        $response = $this->factory->request($request);
        self::assertSame(
            ['page' => 1, 'per_page' => 2000],
            $this->getHttpRequestOptions()['query']
        );

        $meta = $response->getMeta();
        self::assertSame(3, $meta->totalEntries);
        self::assertSame(2000, $meta->perPage);
        self::assertSame(1, $meta->totalPages);
        self::assertNull($meta->nextPage);
        self::assertNull($meta->previousPage);
        self::assertSame(1, $meta->page);
        self::assertSame('https://api.harvestapp.com/v2/users?page=1&per_page=2000', $meta->links['first']);
        self::assertNull($meta->links['next']);
        self::assertNull($meta->links['previous']);
        self::assertSame('https://api.harvestapp.com/v2/users?page=1&per_page=2000', $meta->links['last']);

        self::assertCount(3, $response->getData());
        $user = $response->getData()[0];

        self::assertSame(3230547, $user->id);
        self::assertSame('Jim', $user->firstName);
        self::assertSame('Allen', $user->lastName);
        self::assertSame('jimallen@example.com', $user->email);
        self::assertSame('', $user->telephone);
        self::assertSame('Mountain Time (US & Canada)', $user->timezone);
        self::assertFalse($user->hasAccessToAllFutureProjects);
        self::assertFalse($user->isContractor);
        self::assertTrue($user->isActive);
        self::assertSame('2020-05-01', $user->createdAt->format('Y-m-d'));
        self::assertSame('2020-05-01', $user->updatedAt->format('Y-m-d'));
        self::assertSame(126000, $user->weeklyCapacity);
        self::assertSame(100.0, $user->defaultHourlyRate);
        self::assertSame(50.0, $user->costRate);
        self::assertSame(['Developer'], $user->roles);
        self::assertSame(['member'], $user->accessRoles);
        self::assertSame('https://cache.harvestapp.com/assets/profile_images/abraj_albait_towers.png?1498516481', $user->avatarUrl);
    }
}
