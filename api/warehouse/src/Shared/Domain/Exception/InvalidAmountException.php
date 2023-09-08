<?php

namespace App\Shared\Domain\Exception;

use Exception;

final class InvalidAmountException extends Exception
{
    public static function becauseAmountHasToBeEqualsOrGreaterThanZero(int $invalidValue): self
    {
        return new self(
            sprintf(
                'Invalid amount. Value has to be equals or greater than 0. Provided invalid value: %d',
                $invalidValue)
        );
    }
}
