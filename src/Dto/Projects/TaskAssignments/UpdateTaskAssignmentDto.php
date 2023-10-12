<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments;

use Lsv\TimeharvestSdk\Dto\DtoInterface;

class UpdateTaskAssignmentDto implements DtoInterface
{
    public function __construct(
        public ?bool $isActive = null,
        public ?bool $billable = null,
        public ?float $hourlyRate = null,
        public ?float $budget = null,
    ) {
    }
}
