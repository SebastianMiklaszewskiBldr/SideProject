<?php

namespace App\Write\Product\Shared\Infrastructure\Validator;

use App\Write\Product\Shared\Application\Validator\UuidValidatorInterface;
use Ramsey\Uuid\Rfc4122\Validator;

final readonly class RamseyUuidValidator implements UuidValidatorInterface
{
    public function __construct(private Validator $validator)
    {
    }

    public function validate(string $uuid): bool
    {
        return $this->validator->validate($uuid);
    }
}
