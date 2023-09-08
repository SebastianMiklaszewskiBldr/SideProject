<?php

namespace App\Write\Product\Shared\Infrastructure\Validator;

use Ramsey\Uuid\Rfc4122\Validator;

final readonly class RamseyUuidValidatorFactory
{
    public static function create(): RamseyUuidValidator
    {
        return new RamseyUuidValidator(new Validator());
    }
}
