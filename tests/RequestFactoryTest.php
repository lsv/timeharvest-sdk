<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest;

use Lsv\TimeharvestSdk\Request\ClientsFactory;
use Lsv\TimeharvestSdk\Request\UsersFactory;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;

class RequestFactoryTest extends RequestTestCase
{
    public function testClientFactory(): void
    {
        self::assertInstanceOf(ClientsFactory::class, $this->factory->clients());
    }

    public function testUserFactory(): void
    {
        self::assertInstanceOf(UsersFactory::class, $this->factory->users());
    }
}
