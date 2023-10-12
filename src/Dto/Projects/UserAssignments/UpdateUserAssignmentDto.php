<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Projects\UserAssignments;

use Lsv\TimeharvestSdk\Dto\DtoInterface;

class UpdateUserAssignmentDto implements DtoInterface
{
    public function __construct(
        public ?bool $isActive = null,
        public ?bool $isProjectManager = null,
        public ?bool $useDefaultRates = null,
        public ?float $hourlyRate = null,
        public ?float $budget = null,
    ) {
    }
}
