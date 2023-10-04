---
layout: sub
title: Client
parent: Clients
dataResponse: \Lsv\TimeharvestSdk\Response\Client\ClientData
singleResponse: \Lsv\TimeharvestSdk\Response\Client\ClientResponse
multiResponse: \Lsv\TimeharvestSdk\Response\Client\ClientsResponse
factory: $factory->clients()
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

## List clients

Returns a list of your clients

### Usage

```php
$response = {{page.factory}}->listClients($isActive, $updatedSince, $meta);
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

## Retrieve client

### Usage

```php
$response = $factory->clients()->getClient($client);
```

#### Parameters

| Parameter | Required | Type                                                            | Description                                                     |
|-----------|----------|-----------------------------------------------------------------|-----------------------------------------------------------------|
| `$client` | true     | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientInfoResponse` | The ID or a ClientResponse of the client needed to be retrieved |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Create client

### Usage

```php
$dto = new \Lsv\TimeharvestSdk\Dto\Clients\CreateClientDto($name, $isActive, $address, $currency);
$response = {{page.factory}}->createClient($dto);
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
$response->getData() instanceof {{page.dataResponse}}
```

## Update client

### Usage

```php
$dto = new \Lsv\TimeharvestSdk\Dto\Clients\UpdateClientDto($name, $isActive, $address, $currency);
$response = {{page.factory}}->updateClient($client, $dto);
```

#### Parameters

| Parameter   | Required | Type                                                            | Description                                                   |
|-------------|----------|-----------------------------------------------------------------|---------------------------------------------------------------|
| `$client`   | true     | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientInfoResponse` | The ID or a ClientResponse of the client needed to be updated |
| `$name`     | false    | string                                                          | Name of the client                                            |
| `$isActive` | false    | bool                                                            | Is the client active                                          |
| `$address`  | false    | string                                                          | Address of the client                                         |
| `$currency` | false    | string                                                          | Currency for the client                                       |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Delete client

### Usage

```php
{{page.factory}}->deleteClient($client);
```

#### Parameters

| Parameter | Required | Type                                                            | Description                                                   |
|-----------|----------|-----------------------------------------------------------------|---------------------------------------------------------------|
| `$client` | true     | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientInfoResponse` | The ID or a ClientResponse of the client needed to be deleted |

