<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\TimeEntry;

class TimeEntryUserAssignment
{
    public int $id;
    public bool $isActive;
    public ?bool $isProjectManager;
    public ?float $hourlyRate;
    public ?float $budget;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;
}
