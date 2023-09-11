<?php

namespace App\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class Amount
{
    #[Assert\GreaterThanOrEqual(value: 0, message: 'Invalid AmountValue')]
    public int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }
}
