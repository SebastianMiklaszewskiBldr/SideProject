<?php

namespace App\Shared\Infrastructure;

use App\Shared\Application\Serializer\SerializerInterface;
use Symfony\Component\Serializer\SerializerInterface as SerializerComponent;

final readonly class SymfonySerializer implements SerializerInterface
{
    private const JSON_FORMAT = 'json';

    public function __construct(private SerializerComponent $serializer)
    {
    }

    /**
     * @inheritDoc
     */
    public function deserializeJsonToArrayOfObjects(string $json, string $targetClassName): array
    {
        return $this->serializer->deserialize($json, $targetClassName, self::JSON_FORMAT);
    }
}
