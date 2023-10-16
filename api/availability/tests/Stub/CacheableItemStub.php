<?php

namespace App\Tests\Stub;

use App\Shared\Application\Cache\CacheableInterface;

final readonly class CacheableItemStub implements CacheableInterface
{
    private const ID_SERIALIZED_PROPERTY_NAME = 'id';

    private const NAME_SERIALIZED_PROPERTY_NAME = 'name';

    public function __construct(public string $id, public string $name)
    {
    }

    /**
     * @return array<string, string>
     */
    public function jsonSerialize(): array
    {
        return [
            self::ID_SERIALIZED_PROPERTY_NAME => $this->id,
            self::NAME_SERIALIZED_PROPERTY_NAME => $this->name,
        ];
    }
}
