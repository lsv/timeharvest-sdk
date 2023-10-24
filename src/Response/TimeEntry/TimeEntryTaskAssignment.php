<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\TimeEntry;

class TimeEntryTaskAssignment
{
    public int $id;
    public bool $isActive;
    public ?bool $billable;
    public ?float $hourlyRate;
    public ?float $budget;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;
}
