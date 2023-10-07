<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Tasks;

use Lsv\TimeharvestSdk\Dto\DtoInterface;

readonly class CreateTaskDto implements DtoInterface
{
    public function __construct(
        public string $name,
        public ?bool $billableByDefault = null,
        public ?float $defaultHourlyRate = null,
        public ?bool $isDefault = null,
        public ?bool $isActive = null,
    ) {
    }
}
