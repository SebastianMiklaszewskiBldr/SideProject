<?php

namespace App\Core\Shared\Domain\Entity;

use App\Core\AddProduct\Domain\CannotAddProductToStockException;
use App\Core\AddProduct\Domain\ProductFactory;
use App\Core\Shared\Domain\Event\EventStoreInterface;
use App\Core\Shared\Domain\Event\ProductAdded;
use App\Core\Shared\Domain\Validator\ProductValidator;
use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductCategory;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
use App\Core\Shared\Domain\ValueObject\StockId;
use App\Core\Shared\Domain\ValueObject\StockName;
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
        EventStoreInterface $eventStore,
    ): void {
        if (true === $productValidator->hasStockAlreadyProduct($this->getId(), $productName)) {
            throw CannotAddProductToStockException::becauseStockAlreadyHasProduct($this->getId(), $productName);
        }

        $product = $productFactory->create($productId, $productName, $productCategory, $amount, $this);

        $this->addProductToStock($product);

        $eventStore->pushEvent(
            new ProductAdded($productId->uuid, $productName->name, $this->id, $this->name, $amount->amount)
        );
    }

    public static function createDefault(StockId $id): self
    {
        return new self($id, StockName::default());
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
