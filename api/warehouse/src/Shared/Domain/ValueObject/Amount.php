<?php

namespace App\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\InvalidAmountException;

final readonly class Amount
{
    /**
     * @throws InvalidAmountException
     */
    public function __construct(public int $amount)
    {
        $this->assert();
    }

    /**
     * @throws InvalidAmountException
     */
    private function assert(): void
    {
        if (0 < $this->amount) {
            throw InvalidAmountException::becauseAmountHasToBeEqualsOrGreaterThanZero($this->amount);
        }
    }
}
