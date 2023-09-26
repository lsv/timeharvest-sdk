<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\Clients\Contact\RetrieveContact;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class RetrieveContactTest extends RequestTestCase
{
    public function testRetrieveContactById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_contact.json'))
        );

        $contact = 1;
        $request = new RetrieveContact($contact);

        $this->factory->request($request);

        self::assertStringEndsWith(
            '/contacts/1',
            $this->getHttpRequestOptions()['url']
        );
    }

    public function testRetrieveContactByResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_contact.json'))
        );

        $contact = new ContactData();
        $contact->id = 123;
        $request = new RetrieveContact($contact);

        $this->factory->request($request);

        self::assertStringEndsWith(
            '/contacts/123',
            $this->getHttpRequestOptions()['url']
        );
    }
}
