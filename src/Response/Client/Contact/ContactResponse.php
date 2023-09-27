<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Response\Client\Contact;

use Lsv\TimeharvestSdk\Response\ResponseInterface;

readonly class ContactResponse implements ResponseInterface
{
    public function __construct(private ContactData $data)
    {
    }

    public function getMeta(): null
    {
        return null;
    }

    public function getData(): ContactData
    {
        return $this->data;
    }
}
