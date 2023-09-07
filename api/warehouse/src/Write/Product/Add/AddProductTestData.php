<?php

namespace App\Write\Product\Add;

final readonly class AddProductTestData
{
    /**
     * @return array<string, string|int>
     */
    public function getRequestBody(): array
    {
        return [
            'id' => '5CD03104-C899-4ADB-9093-73D7119F2892',
            'name' => 'TV Rubin 12xABC',
            'category' => 'RTV',
            'amount' => 1
        ];
    }
}
