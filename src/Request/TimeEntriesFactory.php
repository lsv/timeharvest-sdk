<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Request\TimeEntries\ListTimeEntries;
use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskData;
use Lsv\TimeharvestSdk\Response\TimeEntry\TimeEntriesResponse;
use Lsv\TimeharvestSdk\Response\User\UserData;

readonly class TimeEntriesFactory
{
    public function __construct(
        private RequestFactory $factory
    ) {
    }

    public function listTimeEntries(
        UserData|int $user = null,
        ClientInfoData|int $client = null,
        ProjectInfoData|int $project = null,
        TaskData|int $task = null,
        string $externalReferenceId = null,
        bool $isBilled = null,
        bool $isRunning = null,
        \DateTimeInterface $updatedSince = null,
        \DateTimeInterface $from = null,
        \DateTimeInterface $to = null,
        MetaResponse $meta = null,
    ): TimeEntriesResponse {
        return $this->factory->request(new ListTimeEntries(
            $user,
            $client,
            $project,
            $task,
            $externalReferenceId,
            $isBilled,
            $isRunning,
            $updatedSince,
            $from,
            $to,
            $meta
        ));
    }
}
