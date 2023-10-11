<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Projects;

use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class RetrieveProjectTest extends RequestTestCase
{
    public function testResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_project.json'))
        );
        $response = $this->factory->projects()->retrieveProject(1);
        self::assertNull($response->getMeta());
    }
}
