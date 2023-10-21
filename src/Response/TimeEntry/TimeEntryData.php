<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\TimeEntry;

use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Project\ProjectInfoData;
use Lsv\TimeharvestSdk\Response\Task\TaskInfoData;
use Lsv\TimeharvestSdk\Response\User\UserInfoData;

class TimeEntryData
{
    public int $id;
    public ?\DateTimeInterface $spentDate;
    public UserInfoData $user;
    public ClientInfoData $client;
    public ProjectInfoData $project;
    public TaskInfoData $task;
    public TimeEntryUserAssignment $userAssignment;
    public TimeEntryTaskAssignment $taskAssignment;
    public ?TimeEntryExternalReference $externalReference;
    public ?TimeEntryInvoice $invoice;
    public float $hours;
    public float $hoursWithoutTimer;
    public float $roundedHours;
    public string $notes;
    public bool $isLocked;
    public string $lockedReason;
    public bool $isClosed;
    public bool $isBilled;
    public ?\DateTimeInterface $timerStartedAt;
    public ?\DateTimeInterface $startedTime;
    public ?\DateTimeInterface $endedTime;
    public bool $isRunning;
    public bool $billable;
    public bool $budgeted;
    public ?float $billableRate;
    public ?float $costRate;
    public \DateTimeInterface $createdAt;
    public \DateTimeInterface $updatedAt;
}
