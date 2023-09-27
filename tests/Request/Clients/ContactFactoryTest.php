<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients;

use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class ContactFactoryTest extends RequestTestCase
{
    public function testListContacts(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Contact/list_contacts.json'))
        );

        $response = $this->factory->clients()->contacts()->listContacts();

        self::assertSame(
            ['page' => 1, 'per_page' => 2000, 'client_id' => null],
            $this->getHttpRequestOptions()['query']
        );

        self::assertInstanceOf(MetaResponse::class, $response->getMeta());
        self::assertCount(2, $response->getData());
    }

    public function testRetrieveContact(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Contact/retrieve_contact.json'))
        );

        $response = $this->factory->clients()->contacts()->retrieveContact(1);

        self::assertStringEndsWith(
            '/contacts/1',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(ContactData::class, $response->getData());
        self::assertSame(4706479, $response->getData()->id);
    }

    public function testCreateContact(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Contact/retrieve_contact.json'))
        );

        $response = $this->factory->clients()->contacts()->createContact(1, 'first name');

        self::assertStringEndsWith(
            '/contacts',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(ContactData::class, $response->getData());
        self::assertSame(4706479, $response->getData()->id);
    }

    public function testUpdateContact(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/Contact/retrieve_contact.json'))
        );

        $response = $this->factory->clients()->contacts()->updateContact(111);

        self::assertStringEndsWith(
            '/contacts/111',
            $this->getHttpRequestOptions()['url']
        );

        self::assertNull($response->getMeta());
        self::assertInstanceOf(ContactData::class, $response->getData());
        self::assertSame(4706479, $response->getData()->id);
    }

    public function testDeleteContact(): void
    {
        $this->httpClient->setResponseFactory(new MockResponse());

        $this->factory->clients()->contacts()->deleteContact(1);

        self::assertStringEndsWith(
            '/contacts/1',
            $this->getHttpRequestOptions()['url']
        );
    }
}
