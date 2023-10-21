---
layout: sub
title: User
parent: Users
dataResponse: \Lsv\TimeharvestSdk\Response\User\UserData
dataSingleResponse: \Lsv\TimeharvestSdk\Response\User\UserInfoData
singleResponse: \Lsv\TimeharvestSdk\Response\User\UserResponse
multiResponse: \Lsv\TimeharvestSdk\Response\User\UsersResponse
factory: $factory->users()
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

## List users

Retrieve all users

### Usage

```php
$response = {{page.factory}}->listUsers($isActive, $updatedSince, $meta);
$response instanceof {{page.multiResponse}}
$meta = $response->getMeta();
$meta instanceof \Lsv\TimeharvestSdk\Response\MetaResponse
foreach ($response->getData() as $client) {
    $client instanceof {{page.dataResponse}}
}
```

#### Parameters

| Parameter       | Required | Type                                      | Description                                 |
|-----------------|----------|-------------------------------------------|---------------------------------------------|
| `$isActive`     | false    | bool                                      | Select only active or inactive clients      |
| `$updatedSince` | false    | DateTimeInterface                         | Only select clients updated after this date |
| `$meta`         | false    | \Lsv\TimeharvestSdk\Response\MetaResponse | Pagination                                  |

#### Response

```php
$response->getMeta() instanceof \Lsv\TimeharvestSdk\Response\MetaResponse;
$response->getData() array of {{page.dataResponse}}
```

## Current user

### Usage

```php
$response = {{page.factory}}->me();
$response instanceof {{page.singleResponse}}
```

#### Parameters

None

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Retrieve User

### Usage

```php
$response = {{page.factory}}->retrieveUser($user);
$response instanceof {{page.singleResponse}}
```

#### Parameters

| Parameter | Required | Type                                 | Description                                             |
|-----------|----------|--------------------------------------|---------------------------------------------------------|
| `$user`   | true     | int \| `{{page.dataSingleResponse}}` | The ID or a UserData of the user needed to be retrieved |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Create user
### Usage

```php
$dto = new \Lsv\TimeharvestSdk\Dto\User\CreateUserDto(
    $firstName,
    $lastName,
    $email,
    $timezone,
    $hasAccessToAllFutureProjects,
    $isContractor,
    $isActive,
    $weeklyCapacity,
    $defaultHourlyRate,
    $costRate,
    $roles,
    $accessRoles,
);
$response = {{page.factory}}->createUser($dto);
$response instanceof {{page.singleResponse}}
```

#### Parameters


| Parameter                       | Required | Type   | Description                                                                              |
|---------------------------------|----------|--------|------------------------------------------------------------------------------------------|
| `$firstName`                    | true     | string | First name of the user                                                                   |
| `$lastName`                     | true     | string | Last name of the user                                                                    |
| `$email`                        | true     | string | Email of the user                                                                        |
| `$timezone`                     | false    | string | User timezone                                                                            |
| `$hasAccessToAllFutureProjects` | false    | bool   | Whether the user should be automatically added to future projects                        |
| `$isContractor`                 | false    | bool   | Whether the user is a contractor or an employee                                          |
| `$isActive`                     | false    | bool   | Whether the user is active or archived.                                                  |
| `$weeklyCapacity`               | false    | string | The number of hours per week this person is available to work in seconds                 |
| `$defaultHourlyRate`            | false    | string | The billable rate to use for this user when they are added to a project                  |
| `$costRate`                     | false    | string | The cost rate to use for this user when calculating a project’s costs vs billable amount |
| `$roles`                        | false    | bool   | Descriptive names of the business roles assigned to this person                          |
| `$accessRoles`                  | false    | string | Access role(s) that determine the user’s permissions in Harvest                          |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Update user
### Usage

```php
$dto = new \Lsv\TimeharvestSdk\Dto\User\UpdateUserDto(
    $firstName,
    $lastName,
    $email,
    $timezone,
    $hasAccessToAllFutureProjects,
    $isContractor,
    $isActive,
    $weeklyCapacity,
    $defaultHourlyRate,
    $costRate,
    $roles,
    $accessRoles,
);
$response = {{page.factory}}->updateUser($user, $dto);
$response instanceof {{page.singleResponse}}
```

#### Parameters


| Parameter                       | Required | Type                               | Description                                                                              |
|---------------------------------|----------|------------------------------------|------------------------------------------------------------------------------------------|
| `$user`                         | true     | int\|`{{page.dataSingleResponse}}` | User to update                                                                           |
| `$firstName`                    | false    | string                             | First name of the user                                                                   |
| `$lastName`                     | false    | string                             | Last name of the user                                                                    |
| `$email`                        | false    | string                             | Email of the user                                                                        |
| `$timezone`                     | false    | string                             | User timezone                                                                            |
| `$hasAccessToAllFutureProjects` | false    | bool                               | Whether the user should be automatically added to future projects                        |
| `$isContractor`                 | false    | bool                               | Whether the user is a contractor or an employee                                          |
| `$isActive`                     | false    | bool                               | Whether the user is active or archived.                                                  |
| `$weeklyCapacity`               | false    | string                             | The number of hours per week this person is available to work in seconds                 |
| `$defaultHourlyRate`            | false    | string                             | The billable rate to use for this user when they are added to a project                  |
| `$costRate`                     | false    | string                             | The cost rate to use for this user when calculating a project’s costs vs billable amount |
| `$roles`                        | false    | bool                               | Descriptive names of the business roles assigned to this person                          |
| `$accessRoles`                  | false    | string                             | Access role(s) that determine the user’s permissions in Harvest                          |


#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Archive user
### Usage

```php
$response = {{page.factory}}->archiveUser($user);
$response instanceof {{page.singleResponse}}
```

#### Parameters

| Parameter | Required | Type                                 | Description                                            |
|-----------|----------|--------------------------------------|--------------------------------------------------------|
| `$user`   | true     | int \| `{{page.dataSingleResponse}}` | The ID or a UserData of the user needed to be archived |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Delete user
### Usage

```php
$response = {{page.factory}}->retrieveUser($user);
$response instanceof \Lsv\TimeharvestSdk\Response\NullResponse
```

#### Parameters

| Parameter | Required | Type                                 | Description                                           |
|-----------|----------|--------------------------------------|-------------------------------------------------------|
| `$user`   | true     | int \| `{{page.dataSingleResponse}}` | The ID or a UserData of the user needed to be deleted |

#### Response

```php
$response->getData() instanceof \Lsv\TimeharvestSdk\Response\NullResponse
```
