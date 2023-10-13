<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest;

use Lsv\TimeharvestSdk\TimeharvestClient;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TimeharvestClientTest extends TestCase
{
    public function testGetClient(): void
    {
        $obj = new TimeharvestClient('token', 'account');
        $client = $obj->getClient();
        self::assertInstanceOf(HttpClientInterface::class, $client);
        $ref = new \ReflectionClass($client);
        $options = $ref->getProperty('defaultOptions')->getValue($client);
        self::assertSame('token', $options['auth_bearer']);
        self::assertSame('https://api.harvestapp.com/v2/', $options['base_uri']);
        self::assertSame([
            'Harvest-Account-Id: account',
            'User-Agent: lsv/timeharvest-sdk',
            'Content-Type: application/json',
            'Accept: application/json',
        ], $options['headers']);
    }
}
