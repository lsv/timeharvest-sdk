<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Dto\DtoInterface;
use Lsv\TimeharvestSdk\Response\MetaResponse;
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
                /* @infection-ignore-all */
                continue;
            }

            $meta = $property->getValue($this);
            if ($meta instanceof MetaResponse) {
                if (!$nextPage = $meta->nextPage) {
                    /* @infection-ignore-all */
                    continue;
                }

                /** @infection-ignore-all  */
                $query = (string) parse_url($nextPage, PHP_URL_QUERY);
                parse_str($query, $data);
                if (isset($data['page'])) {
                    $values['page'] = (int) $data['page'];
                }

                if (isset($data['per_page'])) {
                    $values['per_page'] = (int) $data['per_page'];
                }

                /* @infection-ignore-all */
                continue;
            }

            if (null === ($value = $property->getValue($this))) {
                /* @infection-ignore-all */
                continue;
            }

            $values[$property->getName()] = $value;
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
