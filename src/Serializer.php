<?php

declare(strict_types=1);

namespace Lsv\TimeharvestSdk;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

use function PHPUnit\Framework\assertIsArray;

class Serializer
{
    /**
     * @return array<string, mixed>
     */
    public static function normalize(object $data): array
    {
        $output = self::getSerializer()->normalize($data, 'json', [
            AbstractObjectNormalizer::SKIP_NULL_VALUES => true,
        ]);

        /* @infection-ignore-all */
        assertIsArray($output);

        return $output;
    }

    /**
     * @param array<string, mixed> $data
     * @param class-string|string  $type
     */
    public static function deserializeArray(array $data, string $type): mixed
    {
        return self::getSerializer()->deserialize(
            json_encode($data, JSON_THROW_ON_ERROR),
            $type,
            'json'
        );
    }

    private static function getSerializer(): SerializerInterface&NormalizerInterface&DenormalizerInterface
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

        return new \Symfony\Component\Serializer\Serializer($normalizers, $encoders);
    }
}
