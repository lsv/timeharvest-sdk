<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Projects;

use Lsv\TimeharvestSdk\Dto\DtoInterface;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;

readonly class UpdateProjectDto implements DtoInterface
{
    public function __construct(
        public null|int|ClientInfoData $clientId = null,
        public ?string $name = null,
        public ?bool $isBillable = null,
        public ?string $billBy = null,
        public ?string $budgetBy = null,
        public ?string $code = null,
        public ?bool $isActive = null,
        public ?bool $isFixedFee = null,
        public ?float $hourlyRate = null,
        public ?float $budget = null,
        public ?bool $budgetIsMonthly = null,
        public ?bool $notifyWhenOverBudget = null,
        public ?float $overBudgetNotificationPercentage = null,
        public ?\DateTimeInterface $overBudgetNotificationDate = null,
        public ?bool $showBudgetToAll = null,
        public ?float $costBudget = null,
        public ?bool $costBudgetIncludeExpenses = null,
        public ?float $fee = null,
        public ?string $notes = null,
        public ?\DateTimeInterface $startsOn = null,
        public ?\DateTimeInterface $endsOn = null,
    ) {
    }
}
