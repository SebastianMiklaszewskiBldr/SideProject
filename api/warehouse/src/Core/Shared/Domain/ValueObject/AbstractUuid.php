<?php

namespace App\Core\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

abstract readonly class AbstractUuid
{
    #[Assert\NotBlank]
    #[Assert\Uuid(versions: [Assert\Uuid::V4_RANDOM])]
    public string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = strtoupper($uuid);
    }
}
