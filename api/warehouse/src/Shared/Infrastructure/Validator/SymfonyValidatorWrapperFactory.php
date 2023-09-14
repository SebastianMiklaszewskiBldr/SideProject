<?php

namespace App\Shared\Infrastructure\Validator;

use Symfony\Component\Validator\ValidatorBuilder;

final readonly class SymfonyValidatorWrapperFactory
{
    public static function create(): SymfonyValidatorWrapper
    {
        $validatorBuilder = new ValidatorBuilder();

        return new SymfonyValidatorWrapper($validatorBuilder->getValidator());
    }
}
