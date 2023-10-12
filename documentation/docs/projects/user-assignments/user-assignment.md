---
layout: sub
title: User assignment
parent: User assignments
grand_parent: Projects
dataResponse: \Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentData
singleResponse: \Lsv\TimeharvestSdk\Response\Project\UserAssignment\UserAssignmentResponse
createDto: \Lsv\TimeharvestSdk\Dto\Projects\UserAssignments\CreateUserAssignmentDto
updateDto: \Lsv\TimeharvestSdk\Dto\Projects\UserAssignments\UpdateUserAssignmentDto
projectResponse: \Lsv\TimeharvestSdk\Response\Project\ProjectData
userResponse: \Lsv\TimeharvestSdk\Response\User\UserData
factory: $factory->projects()->userAssignments()
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

## List user assignments

Returns a list of all user assignments

### Usage

```php
$response = {{page.factory}}->listUserAssignments($isActive, $updatedSince, $meta);
$meta = $response->getMeta();
$meta instanceof \Lsv\TimeharvestSdk\Response\MetaResponse
foreach ($response->getData() as $client) {
    $client instanceof {{page.dataResponse}}
}
```

#### Parameters

| Parameter       | Required | Type                                                  | Description                                 |
|-----------------|----------|-------------------------------------------------------|---------------------------------------------|
| `$isActive`     | false    | bool                                                  | Select only active or inactive clients      |
| `$updatedSince` | false    | DateTimeInterface                                     | Only select clients updated after this date |
| `$meta`         | false    | \Lsv\TimeharvestSdk\Response\MetaResponse             | Pagination                                  |

#### Response

```php
$response->getMeta() instanceof \Lsv\TimeharvestSdk\Response\MetaResponse;
$response->getData() array of {{page.dataResponse}}
```

## List user assignments by project

Returns a list of all user assignments for a project

### Usage

```php
$response = {{page.factory}}->listUserAssignmentsForProject($project, $isActive, $updatedSince, $meta);
$meta = $response->getMeta();
$meta instanceof \Lsv\TimeharvestSdk\Response\MetaResponse
foreach ($response->getData() as $client) {
    $client instanceof {{page.dataResponse}}
}
```

#### Parameters

| Parameter       | Required | Type                                      | Description                                                   |
|-----------------|----------|-------------------------------------------|---------------------------------------------------------------|
| `$project`      | true     | int \| `{{page.projectResponse}}`         | The ID or a ProjectData of the tasks assigned to this project |
| `$isActive`     | false    | bool                                      | Select only active or inactive clients                        |
| `$updatedSince` | false    | DateTimeInterface                         | Only select clients updated after this date                   |
| `$meta`         | false    | \Lsv\TimeharvestSdk\Response\MetaResponse | Pagination                                                    |

#### Response

```php
$response->getMeta() instanceof \Lsv\TimeharvestSdk\Response\MetaResponse;
$response->getData() array of {{page.dataResponse}}
```

## Retrieve user assignment

### Usage

```php
$response = {{page.factory}}->retrieveUserAssignment($project, $assignment);
```

#### Parameters

| Parameter     | Required | Type                              | Description                                                   |
|---------------|----------|-----------------------------------|---------------------------------------------------------------|
| `$project`    | true     | int \| `{{page.projectResponse}}` | The ID or a ProjectData of the project needed to be retrieved |
| `$assignment` | true     | int \| `{{page.dataResponse}}`    | The UserAssignmentData that needed to be retrieved            |                          

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Create user assignment

### Usage

```php
$dto = new {{page.createDto}}(
    $user,
    $isActive,
    $isProjectManager,
    $useDefaultRates,
    $hourlyRate,
    $budget,
);
$response = {{page.factory}}->createTaskAssignment($project, $dto);
```

#### Parameters

| Parameter           | Required | Type                              | Description                                                                 |
|---------------------|----------|-----------------------------------|-----------------------------------------------------------------------------|
| `$project`          | true     | int \| `{{page.projectResponse}}` | The ID or a ProjectData of the tasks assigned to this project               |
| `$user`             | true     | int \| `{{page.userResponse}}`    | The user to associate with the project.                                     |
| `$isActive`         | false    | boolean                           | Whether the user assignment is active or archived.                          |
| `$isProjectManager` | false    | boolean                           | Determines if the user has Project Manager permissions for the project.     |
| `$useDefaultRates`  | false    | boolean                           | Determines which billable rate(s) will be used on the project for this user |
| `$hourlyRate`       | false    | float                             | Custom rate used                                                            |
| `$budget`           | false    | float                             | Budget used when the project’s                                              |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Update user assignment

### Usage

```php
$dto = new {{page.updateDto}}(
    $isActive,
    $isProjectManager,
    $useDefaultRates,
    $hourlyRate,
    $budget,
);
$response = {{page.factory}}->updateUserAssignment($project, $assignment, $dto);
```

#### Parameters

| Parameter           | Required | Type                              | Description                                                                 |
|---------------------|----------|-----------------------------------|-----------------------------------------------------------------------------|
| `$project`          | true     | int \| `{{page.projectResponse}}` | The ID or a ProjectData of the project needed to be created with this task  |
| `$assignment`       | true     | int \| `{{page.dataResponse}}`    | The assignment to be updated                                                |
| `$isActive`         | false    | boolean                           | Whether the user assignment is active or archived.                          |
| `$isProjectManager` | false    | boolean                           | Determines if the user has Project Manager permissions for the project.     |
| `$useDefaultRates`  | false    | boolean                           | Determines which billable rate(s) will be used on the project for this user |
| `$hourlyRate`       | false    | float                             | Custom rate used                                                            |
| `$budget`           | false    | float                             | Budget used when the project’s                                              |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Delete user assignment

### Usage

```php
{{page.factory}}->deleteUserAssignment($project, $assignment);
```

#### Parameters

| Parameter     | Required | Type                              | Description                                                                |
|---------------|----------|-----------------------------------|----------------------------------------------------------------------------|
| `$project`    | true     | int \| `{{page.projectResponse}}` | The ID or a ProjectData of the project needed to be created with this task |
| `$assignment` | true     | int \| `{{page.dataResponse}}`    | The assignment to be updated                                               |
