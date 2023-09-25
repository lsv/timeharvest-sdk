<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk\Request;

use Lsv\TimeharvestSdk\Response\MetaResponse;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

abstract class AbstractRequest
{
    /**
     * @param array<mixed> $data
     */
    protected function deserializeData(array $data, string $type): mixed
    {
        return $this->getSerializer()->deserialize(json_encode($data, JSON_THROW_ON_ERROR), $type, 'json');
    }

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
        $values = new \stdClass();
        foreach ($properties as $property) {
            $values->{$property->getName()} = $property->getValue($this);
        }

        $data = $this->getSerializer()->serialize($values, 'json');

        /* @noinspection JsonEncodingApiUsageInspection */
        return json_decode($data, true, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * @return array{meta: MetaResponse|null, data: mixed}
     */
    abstract public function parseResponse(ResponseInterface $response): array;

    private function getSerializer(): SerializerInterface
    {
        $propertyTypeExtractor = new PropertyInfoExtractor(
            typeExtractors: [
                // new PhpDocExtractor(),
                new ReflectionExtractor(),
            ],
        );

        $normalizers = [
            // new BackedEnumNormalizer(),
            new ArrayDenormalizer(),
            new DateTimeNormalizer(),
            new ObjectNormalizer(
                nameConverter: new CamelCaseToSnakeCaseNameConverter(),
                propertyTypeExtractor: $propertyTypeExtractor
            ),
        ];

        $encoders = [
            new JsonEncoder(),
        ];

        return new Serializer($normalizers, $encoders);
    }
}
