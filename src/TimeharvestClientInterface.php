<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk;

use Symfony\Contracts\HttpClient\HttpClientInterface;

interface TimeharvestClientInterface
{
    public function getClient(): HttpClientInterface;
}
