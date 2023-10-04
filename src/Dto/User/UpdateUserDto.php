<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\User;

use Lsv\TimeharvestSdk\Dto\DtoInterface;

class UpdateUserDto implements DtoInterface
{
    /**
     * @param array<string> $roles
     * @param array<string> $accessRoles
     */
    public function __construct(
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?string $timezone = null,
        public ?bool $hasAccessToAllFutureProjects = null,
        public ?bool $isContractor = null,
        public ?bool $isActive = null,
        public ?int $weeklyCapacity = null,
        public ?float $defaultHourlyRate = null,
        public ?float $costRate = null,
        public ?array $roles = null,
        public ?array $accessRoles = null,
    ) {
    }
}
