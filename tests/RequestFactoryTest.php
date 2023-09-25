<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest;

use Lsv\TimeharvestSdk\Request\ClientsFactory;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;

class RequestFactoryTest extends RequestTestCase
{
    public function testClientFactory(): void
    {
        self::assertInstanceOf(ClientsFactory::class, $this->factory->clients());
    }
}
