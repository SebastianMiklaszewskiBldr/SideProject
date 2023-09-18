<?php

namespace App\Infrastructure\Validator;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final readonly class SymfonyValidatorWrapper
{
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public function validate(object $object): ConstraintViolationListInterface
    {
        return $this->validator->validate($object);
    }
}
