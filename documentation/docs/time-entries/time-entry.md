---
layout: sub
title: Time entry
parent: Time entries
dataResponse: \Lsv\TimeharvestSdk\Response\Project\ProjectData
singleResponse: \Lsv\TimeharvestSdk\Response\Project\ProjectResponse
createDto: \Lsv\TimeharvestSdk\Dto\Projects\CreateProjectDto
updateDto: \Lsv\TimeharvestSdk\Dto\Projects\UpdateProjectDto
factory: $factory->projects()
nav_order: 1
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

## List projects

Returns a list of projects

### Usage

```php
$response = {{page.factory}}->listProjects($isActive, $client, $updatedSince, $meta);
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
| `$client`       | false    | int \| \Lsv\TimeharvestSdk\Response\Client\ClientData | Select only projects for a specific client  |
| `$updatedSince` | false    | DateTimeInterface                                     | Only select clients updated after this date |
| `$meta`         | false    | \Lsv\TimeharvestSdk\Response\MetaResponse             | Pagination                                  |

#### Response

```php
$response->getMeta() instanceof \Lsv\TimeharvestSdk\Response\MetaResponse;
$response->getData() array of {{page.dataResponse}}
```

## Retrieve project

### Usage

```php
$response = {{page.factory}}->retriveProject($project);
```

#### Parameters

| Parameter  | Required | Type                           | Description                                                   |
|------------|----------|--------------------------------|---------------------------------------------------------------|
| `$project` | true     | int \| `{{page.dataResponse}}` | The ID or a ProjectData of the project needed to be retrieved |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Create project

### Usage

```php
$dto = new {{page.createDto}}(
    $clientId,
    $name,
    $isBillable,
    $billBy,
    $budgetBy,
    $code,
    $isActive,
    $isFixedFee,
    $hourlyRate,
    $budget,
    $budgetIsMonthly,
    $notifyWhenOverBudget,
    $overBudgetNotificationPercentage,
    $overBudgetNotificationDate,
    $showBudgetToAll,
    $costBudget,
    $costBudgetIncludeExpenses,
    $fee,
    $notes,
    $startsOn,
    $endsOn,
);
$response = {{page.factory}}->createProject($dto);
```

#### Parameters

| Parameter                              | Required | Type                                                  | Description                                                                                   |
|----------------------------------------|----------|-------------------------------------------------------|-----------------------------------------------------------------------------------------------|
| `$client_id`                           | true     | int \| \Lsv\TimeharvestSdk\Response\Client\ClientData | The ID of the client to associate this project with.                                          |
| `$name`                                | true     | string                                                | The name of the project.                                                                      |
| `$is_billable`                         | true     | boolean                                               | Whether the project is billable or not.                                                       |
| `$bill_by`                             | true     | string                                                | The method by which the project is invoiced.                                                  |
| `$budget_by`                           | true     | string                                                | The method by which the project is budgeted.                                                  |
| `$code`                                | false    | string                                                | The code associated with the project.                                                         |
| `$is_active`                           | false    | boolean                                               | Whether the project is active or archived.                                                    |
| `$is_fixed_fee`                        | false    | boolean                                               | Whether the project is a fixed-fee project or not.                                            |
| `$hourly_rate`                         | false    | float                                                 | Rate for projects billed by Project Hourly Rate.                                              |
| `$budget`                              | false    | float                                                 | The budget in hours for the project when budgeting by time.                                   |
| `$budget_is_monthly`                   | false    | boolean                                               | Option to have the budget reset every month. Defaults to false.                               |
| `$notify_when_over_budget`             | false    | boolean                                               | Whether Project Managers should be notified when the project goes over budget.                |
| `$over_budget_notification_percentage` | false    | float                                                 | Percentage value used to trigger over budget email alerts. Example: use 10.0 for 10.0%.       |
| `$show_budget_to_all`                  | false    | boolean                                               | Option to show project budget to all employees. Does not apply to Total Project Fee projects. |
| `$cost_budget`                         | false    | float                                                 | The monetary budget for the project when budgeting by money.                                  |
| `$cost_budget_include_expenses`        | false    | boolean                                               | Option for budget of Total Project Fees projects to include tracked expenses.                 |
| `$fee`                                 | false    | float                                                 | The amount you plan to invoice for the project. Only used by fixed-fee projects.              |
| `$notes`                               | false    | string                                                | Project notes.                                                                                |
| `$starts_on`                           | false    | DateTimeInterface                                     | Date the project was started.                                                                 |
| `$ends_on`                             | false    | DateTimeInterface                                     | Date the project will end.                                                                    |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Update project

### Usage

```php
$dto = new {{page.updateDto}}(
    $clientId,
    $name,
    $isBillable,
    $billBy,
    $budgetBy,
    $code,
    $isActive,
    $isFixedFee,
    $hourlyRate,
    $budget,
    $budgetIsMonthly,
    $notifyWhenOverBudget,
    $overBudgetNotificationPercentage,
    $overBudgetNotificationDate,
    $showBudgetToAll,
    $costBudget,
    $costBudgetIncludeExpenses,
    $fee,
    $notes,
    $startsOn,
    $endsOn,
);
$response = {{page.factory}}->updateProject($project, $dto);
```

#### Parameters

| Parameter                              | Required | Type                                                  | Description                                                                                   |
|----------------------------------------|----------|-------------------------------------------------------|-----------------------------------------------------------------------------------------------|
| `$project`                             | true     | int \| `{{page.dataResponse}}`                        | The ID or a ProjectData of the project needed to be updated                                   |
| `$client_id`                           | false    | int \| \Lsv\TimeharvestSdk\Response\Client\ClientData | The ID of the client to associate this project with.                                          |
| `$name`                                | false    | string                                                | The name of the project.                                                                      |
| `$is_billable`                         | false    | boolean                                               | Whether the project is billable or not.                                                       |
| `$bill_by`                             | false    | string                                                | The method by which the project is invoiced.                                                  |
| `$budget_by`                           | false    | string                                                | The method by which the project is budgeted.                                                  |
| `$code`                                | false    | string                                                | The code associated with the project.                                                         |
| `$is_active`                           | false    | boolean                                               | Whether the project is active or archived.                                                    |
| `$is_fixed_fee`                        | false    | boolean                                               | Whether the project is a fixed-fee project or not.                                            |
| `$hourly_rate`                         | false    | float                                                 | Rate for projects billed by Project Hourly Rate.                                              |
| `$budget`                              | false    | float                                                 | The budget in hours for the project when budgeting by time.                                   |
| `$budget_is_monthly`                   | false    | boolean                                               | Option to have the budget reset every month. Defaults to false.                               |
| `$notify_when_over_budget`             | false    | boolean                                               | Whether Project Managers should be notified when the project goes over budget.                |
| `$over_budget_notification_percentage` | false    | float                                                 | Percentage value used to trigger over budget email alerts. Example: use 10.0 for 10.0%.       |
| `$show_budget_to_all`                  | false    | boolean                                               | Option to show project budget to all employees. Does not apply to Total Project Fee projects. |
| `$cost_budget`                         | false    | float                                                 | The monetary budget for the project when budgeting by money.                                  |
| `$cost_budget_include_expenses`        | false    | boolean                                               | Option for budget of Total Project Fees projects to include tracked expenses.                 |
| `$fee`                                 | false    | float                                                 | The amount you plan to invoice for the project. Only used by fixed-fee projects.              |
| `$notes`                               | false    | string                                                | Project notes.                                                                                |
| `$starts_on`                           | false    | DateTimeInterface                                     | Date the project was started.                                                                 |
| `$ends_on`                             | false    | DateTimeInterface                                     | Date the project will end.                                                                    |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Delete project

### Usage

```php
{{page.factory}}->deleteProject($project);
```

#### Parameters

| Parameter  | Required | Type                           | Description                                                 |
|------------|----------|--------------------------------|-------------------------------------------------------------|
| `$project` | true     | int \| `{{page.dataResponse}}` | The ID or a ProjectData of the project needed to be deleted |

