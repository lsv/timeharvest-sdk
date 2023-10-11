<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Project;

use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;

class ProjectData
{
    public int $id;
    public ClientInfoData $client;
    public string $name;
    public ?string $code;
    public ?bool $isActive;
    public bool $isBillable;
    public ?bool $isFixedFee;
    public string $billBy;
    public ?float $hourlyRate;
    public ?float $budget;
    public string $budgetBy;
    public ?bool $budgetIsMonthly;
    public ?bool $notifyWhenOverBudget;
    public ?float $overBudgetNotificationPercentage;
    public ?\DateTimeInterface $overBudgetNotificationDate;
    public ?bool $showBudgetToAll;
    public ?float $costBudget;
    public ?bool $costBudgetIncludeExpenses;
    public ?float $fee;
    public ?string $notes;
    public ?\DateTimeInterface $startsOn;
    public ?\DateTimeInterface $endsOn;
    public \DateTimeInterface $createdAt;
    public \DateTimeInterface $updatedAt;
}
