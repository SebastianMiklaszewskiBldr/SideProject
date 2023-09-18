<?php

namespace App\Core\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class ProductName
{
    #[Assert\NotBlank]
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
