<?php

namespace App\Read\Product\ShowOne\Application;

final readonly class ShowOneProductHandler
{
    public function handle(ShowOneProductQuery $query): SingleProductView
    {
        return new SingleProductView(
            '01EF749B-4FDA-47AE-B835-6A086148603C',
            'test',
            'stock',
            1
        );
    }
}
