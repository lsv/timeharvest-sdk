<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Users;

use Lsv\TimeharvestSdk\Request\Users\DeleteUser;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;

class DeleteUserTest extends RequestTestCase
{
    public function testCanDeleteUser(): void
    {
        $user = 1;
        $request = new DeleteUser($user);
        $this->factory->request($request);
        self::assertStringEndsWith('/users/1', $this->getHttpRequestOptions()['url']);
    }
}
