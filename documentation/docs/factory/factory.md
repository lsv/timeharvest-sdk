---
layout: sub
title: Factory
nav_order: 2
has_children: false
permalink: docs/factory
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

### Client

```php
$client = new \Lsv\TimeharvestSdk\TimeharvestClient($accessToken,$accountId);
```

#### Parameters

| Parameter      | Required | Type   | Description  |
|----------------|----------|--------|--------------|
| `$accessToken` | true     | string | Access token |
| `$accountId`   | true     | string | Account ID   |

Create a new set of tokens at https://id.getharvest.com/oauth2/access_tokens/new

The `$accessToken` is "Your token" and `$accountId` is "Account ID" when you have created a new set of tokens

### Factory

```php
$factory = new \Lsv\TimeharvestSdk\RequestFactory($client);
```

#### Parameters

| Parameter    | Required | Type   | Description                                                                              |
|--------------|----------|--------|------------------------------------------------------------------------------------------|
| `$client`    | true     | string | The [TimeharvestClient](#client) |