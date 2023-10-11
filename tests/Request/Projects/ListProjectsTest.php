<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Projects;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class ListProjectsTest extends RequestTestCase
{
    public function testResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_projects.json'))
        );
        $response = $this->factory->projects()->listProjects();
        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
    }
}
