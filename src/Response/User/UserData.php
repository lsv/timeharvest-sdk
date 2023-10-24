<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\User;

class UserData extends UserInfoData
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public ?string $telephone;
    public ?string $timezone;
    public ?bool $hasAccessToAllFutureProjects;
    public ?bool $isContractor;
    public ?bool $isActive;
    public ?int $weeklyCapacity;
    public ?float $defaultHourlyRate;
    public ?float $costRate;
    /**
     * @var string[]
     */
    public ?array $roles;
    /**
     * @var string[]
     */
    public ?array $accessRoles;
    public ?string $avatarUrl;
    public \DateTimeInterface $createdAt;
    public \DateTimeInterface $updatedAt;
}
