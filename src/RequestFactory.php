<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk;

use Lsv\TimeharvestSdk\Request\AbstractRequest;
use Lsv\TimeharvestSdk\Request\ClientsFactory;

class RequestFactory
{
    protected ?\Symfony\Contracts\HttpClient\ResponseInterface $httpResponse = null;

    public function __construct(
        private readonly TimeharvestClientInterface $client
    ) {
    }

    public function clients(): ClientsFactory
    {
        return new ClientsFactory($this);
    }

    public function request(AbstractRequest $request): mixed
    {
        $this->httpResponse = $this->client->getClient()->request(
            $request->getMethod(),
            $request->getUri(),
            [
                'query' => 'GET' === $request->getMethod() ? $request->getQuery() : null,
                'json' => 'GET' !== $request->getMethod() ? $request->getQuery() : null,
            ]
        );

        return $request->parseResponse($this->httpResponse);
    }
}
