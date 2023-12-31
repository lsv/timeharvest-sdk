<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Client\Contact;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class ContactsResponse implements ResponseInterface
{
    /**
     * @param ContactData[] $contacts
     */
    public function __construct(private MetaResponse $meta, private array $contacts)
    {
    }

    public function getMeta(): MetaResponse
    {
        return $this->meta;
    }

    /**
     * @return ContactData[]
     */
    public function getData(): array
    {
        return $this->contacts;
    }
}
