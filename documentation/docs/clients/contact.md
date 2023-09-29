---
layout: sub
title: Contact
parent: Clients
dataResponse: \Lsv\TimeharvestSdk\Response\Client\Contact\ContactData
singleResponse: \Lsv\TimeharvestSdk\Response\Client\Contact\ContactResponse
multiResponse: \Lsv\TimeharvestSdk\Response\Client\Contact\ContactsResponse
factory: $factory->clients()->contacts()
---

<details markdown="block">
<summary class="text-delta">Table of contents</summary>
- TOC
{:toc}
</details>

[See how to create a $factory]({% link docs/factory/factory.md %}){: .btn .btn-outline }

## List contacts

Returns a list of the contacts

### Usage

```php
$response = {{page.factory}}->listContacts($clientId, $updatedSince, $page, $perPage);
$response->getMeta() instanceof \Lsv\TimeharvestSdk\Response\MetaResponse
foreach ($response->getData() as $client) {
    $client instanceof {{page.dataResponse}}
}
```

#### Parameters

| Parameter       | Required | Type                        | Description                                      |
|-----------------|----------|-----------------------------|--------------------------------------------------|
| `$clientId`     | false    | int \| `ClientInfoResponse` | Select only contacts that belongs to this client |
| `$updatedSince` | false    | DateTimeInterface           | Only select contacts updated after this date     |
| `$page`         | false    | int                         | Page number                                      |
| `$perPage`      | false    | int                         | How many per page                                |

#### Response

```php
$response->getMeta() instanceof \Lsv\TimeharvestSdk\Response\MetaResponse;
$response->getData() array of {{page.dataResponse}}
```

## Retrieve contact

### Usage

```php
$response = {{page.factory}}->getContact($contact);
```

#### Parameters

| Parameter  | Required | Type                           | Description                                                       |
|------------|----------|--------------------------------|-------------------------------------------------------------------|
| `$contact` | true     | int \| `{{page.dataResponse}}` | The ID or a ContactResponse of the contact needed to be retrieved |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Create contact

### Usage

```php
$dto = new \Lsv\TimeharvestSdk\Dto\Clients\Contact\CreateContactDto(
    $clientId,
    $firstName,
    $lastName,
    $title,
    $email,
    $phoneOffice,
    $phoneMobile,
    $fax
);
$response = {{page.factory}}->createContact($dto);
```

#### Parameters

| Parameter      | Required | Type                                                                 | Description                                                                      |
|----------------|----------|----------------------------------------------------------------------|----------------------------------------------------------------------------------|
| `$clientId`    | true     | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientInfoResponse`      | The ID or a ClientResponse of the client the contact needs to be associated with |
| `$firstName`   | true     | string                                                               | First name of the contact                                                        |
| `$lastName`    | false    | string                                                               | Last name of the contact                                                         |
| `$title`       | false    | string                                                               | Title of the contact                                                             |
| `$email`       | false    | string                                                               | Email of the contact                                                             |
| `$phoneOffice` | false    | string                                                               | Office phone of the contact                                                      |
| `$phoneMobile` | false    | string                                                               | Mobile phone of the contact                                                      |
| `$fax`         | false    | string                                                               | Fax of the contact                                                               |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Update contact

### Usage

```php
$dto = new \Lsv\TimeharvestSdk\Dto\Clients\Contact\UpdateContactDto(
    $clientId,
    $firstName,
    $lastName,
    $title,
    $email,
    $phoneOffice,
    $phoneMobile,
    $fax
);
$response = {{page.factory}}->updateContact($contact, $dto);
```

#### Parameters

| Parameter      | Required | Type                                                            | Description                                                                      |
|----------------|----------|-----------------------------------------------------------------|----------------------------------------------------------------------------------|
| `$contact`     | true     | int \| `{{page.dataResponse}}`                                  | The ID or a ContactResponse of the contact needed to be updated                  |
| `$clientId`    | false    | int \| `\Lsv\TimeharvestSdk\Response\Client\ClientInfoResponse` | The ID or a ClientResponse of the client the contact needs to be associated with |
| `$firstName`   | false    | string                                                          | First name of the contact                                                        |
| `$lastName`    | false    | string                                                          | Last name of the contact                                                         |
| `$title`       | false    | string                                                          | Title of the contact                                                             |
| `$email`       | false    | string                                                          | Email of the contact                                                             |
| `$phoneOffice` | false    | string                                                          | Office phone of the contact                                                      |
| `$phoneMobile` | false    | string                                                          | Mobile phone of the contact                                                      |
| `$fax`         | false    | string                                                          | Fax of the contact                                                               |

#### Response

```php
$response->getData() instanceof {{page.dataResponse}}
```

## Delete contact

### Usage

```php
{{page.factory}}->deleteContact($contact);
```

#### Parameters

| Parameter  | Required | Type                           | Description                                                     |
|------------|----------|--------------------------------|-----------------------------------------------------------------|
| `$contact` | true     | int \| `{{page.dataResponse}}` | The ID or a ContactResponse of the contact needed to be deleted |

