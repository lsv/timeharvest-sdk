<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest;

use Lsv\TimeharvestSdk\Request\ClientsFactory;
use Lsv\TimeharvestSdk\Request\ProjectsFactory;
use Lsv\TimeharvestSdk\Request\TasksFactory;
use Lsv\TimeharvestSdk\Request\TimeEntriesFactory;
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

    public function testTasksFactory(): void
    {
        self::assertInstanceOf(TasksFactory::class, $this->factory->tasks());
    }

    public function testProjectsFactory(): void
    {
        self::assertInstanceOf(ProjectsFactory::class, $this->factory->projects());
    }

    public function testTimeEntriesFactory(): void
    {
        self::assertInstanceOf(TimeEntriesFactory::class, $this->factory->timeEntries());
    }
}
