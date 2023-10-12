<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project\UserAssignment;

use Lsv\TimeharvestSdk\Response\Project\ProjectData;
use Lsv\TimeharvestSdk\Response\User\UserData;

class UserAssignmentData
{
    public int $id;
    public ProjectData $project;
    public UserData $user;
    public bool $isActive;
    public ?bool $isProjectManager;
    public ?bool $useDefaultRates;
    public ?float $hourlyRate;
    public ?float $budget;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $updatedAt;
}
