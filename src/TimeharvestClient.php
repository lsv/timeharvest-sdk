<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class TimeharvestClient implements TimeharvestClientInterface
{
    private const USER_AGENT = 'lsv/timeharvest-sdk';
    private const BASE_URI = 'https://api.harvestapp.com/v2/';

    public function __construct(
        #[\SensitiveParameter] private string $accessToken,
        #[\SensitiveParameter] private string $accountId
    ) {
    }

    public function getClient(): HttpClientInterface
    {
        return HttpClient::create([
            'base_uri' => self::BASE_URI,
            'auth_bearer' => $this->accessToken,
            'headers' => [
                'Harvest-Account-Id' => $this->accountId,
                'User-Agent' => self::USER_AGENT,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);
    }
}
