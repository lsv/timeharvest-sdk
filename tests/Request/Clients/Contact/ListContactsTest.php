<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdkTest\Request\Clients\Contact;

use Lsv\TimeharvestSdk\Request\Clients\Contact\ListContacts;
use Lsv\TimeharvestSdk\Response\Client\ClientInfoData;
use Lsv\TimeharvestSdk\Response\Client\Contact\ContactData;
use Lsv\TimeharvestSdkTest\Request\RequestTestCase;
use Symfony\Component\HttpClient\Response\MockResponse;

class ListContactsTest extends RequestTestCase
{
    public function testListContactsById(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_contacts.json'))
        );

        $request = new ListContacts(1);
        $response = $this->factory->request($request);

        self::assertSame(
            ['page' => 1, 'per_page' => 2000, 'client_id' => 1],
            $this->getHttpRequestOptions()['query']
        );

        $meta = $response->getMeta();
        self::assertNotNull($meta);
        self::assertSame(2, $meta->totalEntries);

        self::assertCount(2, $response->getData());
        /** @var ContactData $contact */
        $contact = $response->getData()[0];
        self::assertSame(4706479, $contact->id);
        self::assertSame('Owner', $contact->title);
        self::assertSame('Jane', $contact->firstName);
        self::assertSame('Doe', $contact->lastName);
        self::assertSame('janedoe@example.com', $contact->email);
        self::assertSame('(203) 697-8885', $contact->phoneOffice);
        self::assertSame('(203) 697-8886', $contact->phoneMobile);
        self::assertSame('(203) 697-8887', $contact->fax);
        self::assertSame('2017-06-26', $contact->createdAt->format('Y-m-d'));
        self::assertSame('2017-06-26', $contact->updatedAt->format('Y-m-d'));
        self::assertSame(5735774, $contact->client->id);
        self::assertSame('ABC Corp', $contact->client->name);
    }

    public function testListClientsByClientResponse(): void
    {
        $this->httpClient->setResponseFactory(
            new MockResponse((string) file_get_contents(__DIR__.'/list_contacts.json'))
        );

        $client = new ClientInfoData();
        $client->id = 1;
        $request = new ListContacts($client);
        $this->factory->request($request);

        self::assertSame(
            ['page' => 1, 'per_page' => 2000, 'client_id' => 1],
            $this->getHttpRequestOptions()['query']
        );
    }
}
