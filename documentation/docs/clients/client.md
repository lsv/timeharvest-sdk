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
    $client instanceof \Lsv\TimeharvestSdk\Response\Client\ClientResponse
}
```

#### Parameters

| Parameter       | Required | Type              | Description                                 |
|-----------------|----------|-------------------|---------------------------------------------|
| `$isActive`     | false    | bool              | Select only active or inactive clients      |
| `$updatedSince` | false    | DateTimeInterface | Only select clients updated after this date |
| `$page`         | false    | int               | Page number                                 |
| `$perPage`      | false    | int               | How many per page                           |

#### Response

```php
$response['meta'] instanceof \Lsv\TimeharvestSdk\Response\MetaResponse;
$response['data'] array of \Lsv\TimeharvestSdk\Response\Client\ClientResponse
```

### Retrieve client

```php
$response = $factory->clients()->getClient($client);
```

#### Parameters

| Parameter | Required | Type                                                        | Description                                                     |
|-----------|----------|-------------------------------------------------------------|-----------------------------------------------------------------|
| `$client` | true     | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientResponse` | The ID or a ClientResponse of the client needed to be retrieved |

#### Response

```php
$response['data'] instanceof \Lsv\TimeharvestSdk\Response\Client\ClientResponse
```

### Create client

```php
$response = $factory->clients()->createClient($name, $isActive, $address, $currency);
```

#### Parameters

| Parameter   | Required | Type   | Description             |
|-------------|----------|--------|-------------------------|
| `$name`     | true     | string | Name of the client      |
| `$isActive` | false    | bool   | Is the client active    |
| `$address`  | false    | string | Address of the client   |
| `$currency` | false    | string | Currency for the client |

#### Response

```php
$response['data'] instanceof \Lsv\TimeharvestSdk\Response\Client\ClientResponse
```

### Update client

```php
$response = $factory->clients()->updateClient($client, $name, $isActive, $address, $currency);
```

#### Parameters

| Parameter   | Required | Type                                                        | Description                                                   |
|-------------|----------|-------------------------------------------------------------|---------------------------------------------------------------|
| `$client`   | true     | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientResponse` | The ID or a ClientResponse of the client needed to be updated |
| `$name`     | false    | string                                                      | Name of the client                                            |
| `$isActive` | false    | bool                                                        | Is the client active                                          |
| `$address`  | false    | string                                                      | Address of the client                                         |
| `$currency` | false    | string                                                      | Currency for the client                                       |

#### Response

```php
$response['data'] instanceof \Lsv\TimeharvestSdk\Response\Client\ClientResponse
```

### Delete client

```php
$factory->clients()->deleteClient($client);
```

#### Parameters

| Parameter | Required | Type                                                        | Description                                                   |
|-----------|----------|-------------------------------------------------------------|---------------------------------------------------------------|
| `$client` | true     | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientResponse` | The ID or a ClientResponse of the client needed to be deleted |
