<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Dto\Clients\Contact;

use Lsv\TimeharvestSdk\Dto\DtoInterface;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;

class UpdateContactDto implements DtoInterface
{
    public function __construct(
        public readonly null|int|ClientInfoData $clientId = null,
        public readonly ?string $firstName = null,
        public readonly ?string $lastName = null,
        public readonly ?string $title = null,
        public readonly ?string $email = null,
        public readonly ?string $phoneOffice = null,
        public readonly ?string $phoneMobile = null,
        public readonly ?string $fax = null
    ) {
    }
}
