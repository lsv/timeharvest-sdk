Timeharvest PHP SDK
===================

[![Workflow status](https://github.com/lsv/timeharvest-sdk/actions/workflows/ci.yml/badge.svg)](https://github.com/lsv/timeharvest-sdk)
[![Coverage](https://codecov.io/gh/lsv/timeharvest-sdk/graph/badge.svg?token=YWdgJXRlXH)](https://codecov.io/gh/lsv/timeharvest-sdk)
[![Mutation testing badge](https://img.shields.io/endpoint?style=flat&url=https%3A%2F%2Fbadge-api.stryker-mutator.io%2Fgithub.com%2Flsv%2Ftimeharvest-sdk%2Fmaster)](https://dashboard.stryker-mutator.io/reports/github.com/lsv/timeharvest-sdk/master)
[![SymfonyInsight](https://insight.symfony.com/projects/f1ef3847-03ec-4b4b-b5bb-f6707c14e348/mini.svg)](https://insight.symfony.com/projects/f1ef3847-03ec-4b4b-b5bb-f6707c14e348)

PHP SDK for [Timeharvest](https://help.getharvest.com/api-v2/)

### Install

```bash
composer require lsv/timeharvest-sdk
```

### Example usage

```php
$factory = new \Lsv\TimeharvestSdk\RequestFactory(
    new \Lsv\TimeharvestSdk\TimeharvestClient($accessToken,$accountId)
);

$response = $factory->clients()->listClients($isActive, $updatedSince, $page, $perPage);
foreach ($response['data'] as $client) {
    // $client instanceof \Lsv\TimeharvestSdk\Response\Client\ClientResponse
}
```

### [Documentation](https://lsv.github.io/timeharvest-sdk/)

### License
The MIT License (MIT)

Copyright (c) 2023 Martin Aarhof martin.aarhof@gmail.com

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

