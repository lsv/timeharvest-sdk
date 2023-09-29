<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Clients;

use Lsv\TimeharvestSdk\Dto\DtoInterface;

readonly class CreateClientDto implements DtoInterface
{
    public function __construct(
        public string $name,
        public ?bool $isActive = null,
        public ?string $address = null,
        public ?string $currency = null,
    ) {
    }
}
