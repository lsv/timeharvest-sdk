<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Client;

class ClientData extends ClientInfoData
{
    public bool $isActive;
    public ?string $address;
    public string $statementKey;
    public ?string $currency;
    public \DateTimeInterface $createdAt;
    public \DateTimeInterface $updatedAt;
}
