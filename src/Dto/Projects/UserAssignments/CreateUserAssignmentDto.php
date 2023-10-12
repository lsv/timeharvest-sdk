<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Projects\UserAssignments;

use Lsv\TimeharvestSdk\Dto\DtoInterface;
use Lsv\TimeharvestSdk\Response\User\UserData;

readonly class CreateUserAssignmentDto implements DtoInterface
{
    public function __construct(
        public int|UserData $userId,
        public ?bool $isActive = null,
        public ?bool $isProjectManager = null,
        public ?bool $useDefaultRates = null,
        public ?float $hourlyRate = null,
        public ?float $budget = null,
    ) {
    }

    public function getUserId(): int
    {
        if ($this->userId instanceof UserData) {
            return $this->userId->id;
        }

        return $this->userId;
    }
}
