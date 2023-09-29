<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Clients;

use Lsv\TimeharvestSdk\Dto\DtoInterface;

readonly class UpdateClientDto implements DtoInterface
{
    public function __construct(
        public ?string $name = null,
        public ?bool $isActive = null,
        public ?string $address = null,
        public ?string $currency = null,
    ) {
    }
}
