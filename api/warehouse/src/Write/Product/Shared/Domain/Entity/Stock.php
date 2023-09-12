<?php

namespace App\Write\Product\Shared\Domain\Entity;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductCategory;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Shared\Domain\ValueObject\StockName;
use App\Write\Product\Add\Domain\CannotAddProductToStockException;
use App\Write\Product\Add\Domain\ProductFactory;
use App\Write\Product\Shared\Application\Validator\ProductValidator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'stocks')]
final class Stock
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid', nullable: false)]
    private readonly string $id;

    #[ORM\Column(name: 'name', type: 'string', nullable: false)]
    private string $name;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\OneToMany(mappedBy: 'stock', targetEntity: Product::class, cascade: ['REMOVE', 'PERSIST'], orphanRemoval: true, indexBy: 'name')]
    private Collection $products;

    public function __construct(StockId $id, StockName $name)
    {
        $this->id = $id->uuid;
        $this->name = $name->name;

        $this->products = new ArrayCollection([]);
    }

    public static function createDefault(StockId $id): self
    {
        return new self($id, StockName::default());
    }

    /**
     * @throws CannotAddProductToStockException
     */
    public function addProduct(
        ProductId $productId,
        ProductName $productName,
        ProductCategory $productCategory,
        Amount $amount,
        ProductValidator $productValidator,
        ProductFactory $productFactory,
    ): void {
        if (true === $productValidator->hasStockAlreadyProduct($this->getId(), $productName)) {
            throw CannotAddProductToStockException::becauseStockAlreadyHasProduct($this->getId(), $productName);
        }

        $product = $productFactory->create($productId, $productName, $productCategory, $amount, $this);

        $this->addProductToStock($product);
    }

    private function getId(): StockId
    {
        return new StockId($this->id);
    }

    private function addProductToStock(Product $product): void
    {
        $this->products->add($product);
    }
}
