<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\Clients\Contact\UpdateContact;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class UpdateContactTest extends RequestTestCase
{
    public function testUpdateContactById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_contact.json'))
        );

        $contact = 12;
        $client = 1;
        $request = new UpdateContact(
            $contact,
            $client,
            'first',
            'last',
            'title',
            'email@example.com',
            '123',
            '456',
            '789',
        );

        $this->factory->request($request);

        self::assertSame(
            [
                'client_id' => 1,
                'first_name' => 'first',
                'last_name' => 'last',
                'title' => 'title',
                'email' => 'email@example.com',
                'phone_office' => '123',
                'phone_mobile' => '456',
                'fax' => '789',
            ],
            $this->getHttpRequestOptions()['array']
        );

        self::assertStringEndsWith(
            '/contacts/12',
            $this->getHttpRequestOptions()['url']
        );
    }

    public function testUpdateContactByResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_contact.json'))
        );

        $contact = new ContactData();
        $contact->id = 321;

        $request = new UpdateContact($contact);

        $this->factory->request($request);

        self::assertStringEndsWith(
            '/contacts/321',
            $this->getHttpRequestOptions()['url']
        );
    }
}
