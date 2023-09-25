---
layout: sub
title: Client
parent: Clients
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

### List clients

Returns a list of your clients

#### Usage

```php
$response = $factory->clients()->listClients($isActive, $updatedSince, $page, $perPage);
foreach ($response['data'] as $client) {
    // $client instanceof \Lsv\TimeharvestSdk\Response\Client\ClientResponse
}
```

#### Parameters

| Parameter      | Required | Type   | Description |
|----------------| --- |--------|-------------|
| `$isActive`    | false | bool | Select only active or inactive clients |
| `$updatedSince` | false | DateTimeInterface | Only select clients updated after this date |
| `$page`        | false | int    | Page number |
| `$perPage`       | false | int    | How many per page |

#### Response

```php
$response['meta'] instanceof \Lsv\TimeharvestSdk\Response\MetaResponse;
$response['data'] array of \Lsv\TimeharvestSdk\Response\Client\ClientResponse
```

### Retrieve client

### Create client

### Update client

### Delete client