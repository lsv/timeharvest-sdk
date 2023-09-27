<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\Clients\Contact\CreateContact;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class CreateContactTest extends RequestTestCase
{
    public function testCreateContactById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_contact.json'))
        );

        $client = 1;
        $request = new CreateContact(
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
            '/contacts',
            $this->getHttpRequestOptions()['url']
        );
    }

    public function testCreateContactByResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/retrieve_contact.json'))
        );

        $client = new ClientInfoData();
        $client->id = 123;
        $request = new CreateContact($client, 'first name');

        $this->factory->request($request);

        self::assertStringEndsWith(
            '/contacts',
            $this->getHttpRequestOptions()['url']
        );
    }
}
