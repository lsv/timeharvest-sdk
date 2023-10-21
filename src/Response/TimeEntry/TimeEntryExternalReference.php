<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\TimeEntry;

class TimeEntryExternalReference
{
    public int $id;
    public ?int $groupId;
    public ?int $accountId;
    public ?string $permalink;
    public ?string $service;
    public ?string $serviceIconUrl;
}
