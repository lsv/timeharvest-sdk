<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Task;

class TaskData extends TaskInfoData
{
    public ?bool $billableByDefault;
    public ?float $defaultHourlyRate;
    public bool $isDefault;
    public bool $isActive;
    public \DateTimeInterface $createdAt;
    public \DateTimeInterface $updatedAt;
}
