<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\Clients\Contact\DeleteContact;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class DeleteContactTest extends RequestTestCase
{
    public function testDeleteContactById(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse());

        $contact = 1;
        $request = new DeleteContact($contact);

        $response = $this->factory->request($request);

        self::assertStringEndsWith(
            '/contacts/1',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertNull($response->getData());
    }

    public function testRetrieveContactByResponse(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse());

        $contact = new ContactData();
        $contact->id = 123;
        $request = new DeleteContact($contact);

        $this->factory->request($request);

        self::assertStringEndsWith(
            '/contacts/123',
            $this->getHttpRequestOptions()['url']
        );
    }
}
