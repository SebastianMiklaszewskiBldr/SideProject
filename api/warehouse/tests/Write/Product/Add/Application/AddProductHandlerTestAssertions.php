<?php

namespace App\Tests\Write\Product\Add\Application;

use App\Shared\Domain\ValueObject\ProductId;

final readonly class AddProductHandlerTestAssertions
{
    public function __construct(private AddProductHandlerTest $testCase)
    {
    }

    public function assertProductWasSaved(ProductId $productId): void
    {
        $this->testCase::assertTrue(false);
    }
}
