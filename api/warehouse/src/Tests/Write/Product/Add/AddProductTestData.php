<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\Tests\Write\Product\Add;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Write\Product\Add\Application\AddProductCommand;

final readonly class AddProductTestData
{
    /**
     * @return array<string, string|int>
     */
    public function getRequestBody(): array
    {
        return [
            'id' => $this->getProductId()->uuid,
            'name' => $this->getProductName()->name,
            'category' => $this->getCategory()->category,
            'amount' => $this->getAmount()->amount,
        ];
    }

    private function getProductId(): ProductId
    {
        return new ProductId('3260BFA7-DD48-41FE-8A7D-0A518822A8E7');
    }

    private function getProductName(): ProductName
    {
        return new ProductName('TV Rubin 12xABC');
    }

    private function getCategory(): ProductCategory
    {
        return new ProductCategory('RTV');
    }

    private function getAmount(): Amount
    {
        return new Amount(1);
    }

    public function getCommand(): AddProductCommand
    {
        return new AddProductCommand(
            $this->getProductId(),
            $this->getProductName(),
            $this->getCategory(),
            $this->getAmount()
        );
    }
}
