<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Dto\DtoInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractRequest
{
    public function getMethod(): string
    {
        return 'GET';
    }

    abstract public function getUri(): string;

    /**
     * @return array<string, mixed>
     */
    public function getQuery(): array
    {
        $ref = new \ReflectionClass($this);
        $properties = $ref->getProperties(\ReflectionProperty::IS_PUBLIC);
        $values = [];
        foreach ($properties as $property) {
            if ($property->getValue($this) instanceof DtoInterface) {
                $values = \Lsv\TimeharvestSdk\Serializer::normalize($property->getValue($this));
            } else {
                if (null === ($value = $property->getValue($this))) {
                    continue;
                }

                $values[$property->getName()] = $value;
            }
        }

        $this->preQuery($values);

        return \Lsv\TimeharvestSdk\Serializer::normalize((object) $values);
    }

    /** @infection-ignore-all */
    /**
     * @param array<string, mixed> $values
     */
    protected function preQuery(array &$values): void
    {
    }

    abstract public function parseResponse(ResponseInterface $response): mixed;
}
