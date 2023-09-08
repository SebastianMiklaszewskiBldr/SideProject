<?php

namespace App\Write\Product\Shared\Application\Validator;

interface UuidValidatorInterface
{
    public function validate(string $uuid): bool;
}
