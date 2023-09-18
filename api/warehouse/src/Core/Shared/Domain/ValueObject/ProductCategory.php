<?php

namespace App\Core\Shared\Domain\ValueObject;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class ProductCategory
{
    #[Assert\NotBlank]
    public string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }
}
