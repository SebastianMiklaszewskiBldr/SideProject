<?php

namespace App\Shared\Application\Serializer;

interface SerializerInterface
{
    /**
     * @return array<int, object>
     */
    public function deserializeJsonToArrayOfObjects(string $json, string $targetClassName): array;
}
