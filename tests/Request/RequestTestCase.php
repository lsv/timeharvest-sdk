<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request;

use Lsv\TimeharvestSdk\RequestFactory;
use Lsv\TimeharvestSdk\TimeharvestClientInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class RequestTestCase extends TestCase
{
    protected MockHttpClient $httpClient;
    protected RequestFactory $factory;

    protected function setUp(): void
    {
        $this->httpClient = new MockHttpClient();
        $timeharvestClient = new class($this->httpClient) implements TimeharvestClientInterface {
            public function __construct(private readonly HttpClientInterface $client)
            {
            }

            public function getClient(): HttpClientInterface
            {
                return $this->client;
            }
        };

        $this->factory = new RequestFactory($timeharvestClient);
    }

    /**
     * @return array<mixed>
     */
    protected function getHttpRequestOptions(): array
    {
        /** @var MockResponse $response */
        $response = (new \ReflectionProperty($this->factory, 'httpResponse'))->getValue($this->factory);

        return array_merge(
            ['url' => $response->getInfo('url')],
            ['method' => $response->getInfo('http_method')],
            ['array' => json_decode($response->getRequestOptions()['body'] ?? '{}', true, 512, JSON_THROW_ON_ERROR)],
            $response->getRequestOptions()
        );
    }
}
