<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Client\Contact;

use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;

class ContactData
{
    public int $id;
    public ClientInfoData $client;
    public ?string $title;
    public string $firstName;
    public ?string $lastName;
    public ?string $email;
    public ?string $phoneOffice;
    public ?string $phoneMobile;
    public ?string $fax;
    public \DateTimeInterface $createdAt;
    public \DateTimeInterface $updatedAt;
}
