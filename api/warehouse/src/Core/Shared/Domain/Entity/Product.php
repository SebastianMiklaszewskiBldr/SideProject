<?php

namespace App\Core\Shared\Domain\Entity;

use App\Core\Shared\Domain\ValueObject\Amount;
use App\Core\Shared\Domain\ValueObject\ProductCategory;
use App\Core\Shared\Domain\ValueObject\ProductId;
use App\Core\Shared\Domain\ValueObject\ProductName;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

#[ORM\Entity]
#[ORM\Table(name: 'products', uniqueConstraints: [new UniqueConstraint('unique_stock_product', ['name', 'stock'])])]
final class Product
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid', nullable: false)]
    private readonly string $id;

    #[ORM\Column(name: 'name', type: 'string', nullable: false)]
    private string $name;

    #[ORM\Column(name: 'category', type: 'string', nullable: false)]
    private string $category;

    #[ORM\Column(name: 'amount', type: 'integer', nullable: false)]
    private int $amount;

    #[ORM\ManyToOne(targetEntity: Stock::class, inversedBy: 'id')]
    #[ORM\JoinColumn(name: 'stock', nullable: false)]
    private Stock $stock;

    public function __construct(
        ProductId $id,
        ProductName $name,
        ProductCategory $category,
        Amount $amount,
        Stock $stock,
    ) {
        $this->id = $id->uuid;
        $this->name = $name->name;
        $this->category = $category->category;
        $this->amount = $amount->amount;
        $this->stock = $stock;
    }
}
