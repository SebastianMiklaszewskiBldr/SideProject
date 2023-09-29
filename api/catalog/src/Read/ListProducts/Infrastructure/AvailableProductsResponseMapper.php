<?php

namespace App\Read\ListProducts\Infrastructure;

use App\Read\ListProducts\Domain\AvailableProduct;
use App\Shared\Application\Serializer\SerializerInterface;

final readonly class AvailableProductsResponseMapper
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    /**
     * @return array<AvailableProduct>
     */
    public function map(string $responseJson): array
    {
        return $this->serializer->deserializeJsonToArrayOfObjects($responseJson, AvailableProduct::class);
    }
}
