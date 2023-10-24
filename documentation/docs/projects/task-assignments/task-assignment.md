---
layout: sub
title: Task assignment
parent: Task assignments
grand_parent: Projects
dataResponse: \Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentData
singleResponse: \Lsv\TimeharvestSdk\Response\Project\TaskAssignment\TaskAssignmentResponse
createDto: \Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments\CreateTaskAssignmentDto
updateDto: \Lsv\TimeharvestSdk\Dto\Projects\TaskAssignments\UpdateTaskAssignmentDto
projectResponse: \Lsv\TimeharvestSdk\Response\Project\ProjectInfoData
factory: $factory->projects()->taskAssignments()
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

## List task assignments

Returns a list of all task assignments

### Usage

```php
$response = {{page.factory}}->listTaskAssignments($isActive, $updatedSince, $meta);
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

## List task assignments by project

Returns a list of all task assignments for a project

### Usage

```php
$response = {{page.factory}}->listTaskAssignmentsForProject($project, $isActive, $updatedSince, $meta);
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

## Retrieve task assignment

### Usage

```php
$response = {{page.factory}}->retrieveTaskAssignment($project, $assignment);
```

#### Parameters

| Parameter     | Required | Type                              | Description                                                   |
|---------------|----------|-----------------------------------|---------------------------------------------------------------|
| `$project`    | true     | int \| `{{page.projectResponse}}` | The ID or a ProjectData of the project needed to be retrieved |
| `$assignment` | true     | int \| `{{page.dataResponse}}`    | The TaskAssignmentData that needed to be retrieved            |                          

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Create task assignment

### Usage

```php
$dto = new {{page.createDto}}(
    $task,
    $isActive,
    $billable,
    $hourlyRate,
    $budget,
);
$response = {{page.factory}}->createTaskAssignment($project, $dto);
```

#### Parameters

| Parameter      | Required | Type                                                | Description                                                                |
|----------------|----------|-----------------------------------------------------|----------------------------------------------------------------------------|
| `$project`     | true     | int \| `{{page.projectResponse}}`                   | The ID or a ProjectData of the project needed to be created with this task |
| `$task`        | true     | int \| `\Lsv\TimeharvestSdk\Response\Task\TaskData` | The ID of the task to associate this project with.                         |
| `$is_active`   | false    | boolean                                             | Whether the project is active or archived.                                 |
| `$billable`    | false    | boolean                                             | Whether the project is billable or not.                                    |
| `$hourly_rate` | false    | float                                               | Rate for projects billed by Project Hourly Rate.                           |
| `$budget`      | false    | float                                               | The budget in hours for the project when budgeting by time.                |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Update task assignment

### Usage

```php
$dto = new {{page.updateDto}}(
    $isActive,
    $billable,
    $hourlyRate,
    $budget,
);
$response = {{page.factory}}->updateTaskAssignment($project, $assignment, $dto);
```

#### Parameters

| Parameter      | Required | Type                                                | Description                                                                |
|----------------|----------|-----------------------------------------------------|----------------------------------------------------------------------------|
| `$project`     | true     | int \| `{{page.projectResponse}}`                   | The ID or a ProjectData of the project needed to be created with this task |
| `$task`        | true     | int \| `\Lsv\TimeharvestSdk\Response\Task\TaskData` | The ID of the task to associate this project with.                         |
| `$is_active`   | false    | boolean                                             | Whether the project is active or archived.                                 |
| `$billable`    | false    | boolean                                             | Whether the project is billable or not.                                    |
| `$hourly_rate` | false    | float                                               | Rate for projects billed by Project Hourly Rate.                           |
| `$budget`      | false    | float                                               | The budget in hours for the project when budgeting by time.                |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Delete task assignment

### Usage

```php
{{page.factory}}->deleteTaskAssignment($project, $assignment);
```

#### Parameters

| Parameter      | Required | Type                                                | Description                                                                |
|----------------|----------|-----------------------------------------------------|----------------------------------------------------------------------------|
| `$project`     | true     | int \| `{{page.projectResponse}}`                   | The ID or a ProjectData of the project needed to be created with this task |
| `$task`        | true     | int \| `\Lsv\TimeharvestSdk\Response\Task\TaskData` | The ID of the task to associate this project with.                         |
