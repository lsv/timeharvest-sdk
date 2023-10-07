---
layout: sub
title: Task
parent: Tasks
dataResponse: \Lsv\TimeharvestSdk\Response\Task\TaskData
singleResponse: \Lsv\TimeharvestSdk\Response\Task\TaskResponse
createDto: \Lsv\TimeharvestSdk\Dto\Tasks\CreateTaskDto
updateDto: \Lsv\TimeharvestSdk\Dto\Tasks\UpdateTaskDto
factory: $factory->tasks()
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

## List tasks

Returns a list of tasks

### Usage

```php
$response = {{page.factory}}->listTasks($isActive, $updatedSince, $meta);
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

## Retrieve task

### Usage

```php
$response = {{page.factory}}->retriveTask($task);
```

#### Parameters

| Parameter | Required | Type                           | Description                                             |
|-----------|----------|--------------------------------|---------------------------------------------------------|
| `$task`   | true     | int \| `{{page.dataResponse}}` | The ID or a TaskData of the task needed to be retrieved |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Create task

### Usage

```php
$dto = new {{page.createDto}}($name, $billableByDefault, $defaultHourlyRate, $isDefault, $isActive);
$response = {{page.factory}}->createTask($dto);
```

#### Parameters

| Parameter            | Required | Type   | Description                                                                                      |
|----------------------|----------|--------|--------------------------------------------------------------------------------------------------|
| `$name`              | true     | string | Name of the task                                                                                 |
| `$billableByDefault` | false    | bool   | Used in determining whether default tasks should be marked billable when creating a new project. |
| `$defaultHourlyRate` | false    | float  | The default hourly rate to use for this task when it is added to a project                       |
| `$isDefault`         | false    | bool   | Whether this task should be automatically added to future projects                               |
| `$isActive`          | false    | bool   | Whether this task is active or archived                                                          |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Update task

### Usage

```php
$dto = new {{page.updateDto}}($name, $billableByDefault, $defaultHourlyRate, $isDefault, $isActive);
$response = {{page.factory}}->updateTask($task, $dto);
```

#### Parameters

| Parameter            | Required | Type                           | Description                                                                                      |
|----------------------|----------|--------------------------------|--------------------------------------------------------------------------------------------------|
| `$task`              | true     | int \| `{{page.dataResponse}}` | The ID or a TaskData of the task needed to be updated                                            |
| `$name`              | false    | string                         | Name of the task                                                                                 |
| `$billableByDefault` | false    | bool                           | Used in determining whether default tasks should be marked billable when creating a new project. |
| `$defaultHourlyRate` | false    | float                          | The default hourly rate to use for this task when it is added to a project                       |
| `$isDefault`         | false    | bool                           | Whether this task should be automatically added to future projects                               |
| `$isActive`          | false    | bool                           | Whether this task is active or archived                                                          |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Delete task

### Usage

```php
{{page.factory}}->deleteTask($task);
```

#### Parameters

| Parameter | Required | Type                           | Description                                           |
|-----------|----------|--------------------------------|-------------------------------------------------------|
| `$task`   | true     | int \| `{{page.dataResponse}}` | The ID or a TaskData of the task needed to be deleted |

