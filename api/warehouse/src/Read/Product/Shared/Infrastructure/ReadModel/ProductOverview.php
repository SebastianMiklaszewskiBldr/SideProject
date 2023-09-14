<?php

namespace App\Read\Product\Shared\Infrastructure\ReadModel;

use App\Shared\Domain\ValueObject\Amount;
use App\Shared\Domain\ValueObject\ProductId;
use App\Shared\Domain\ValueObject\ProductName;
use App\Shared\Domain\ValueObject\StockId;
use App\Shared\Domain\ValueObject\StockName;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(readOnly: true)]
#[ORM\Table(name: 'product_overview')]
final readonly class ProductOverview
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'guid')]
    private string $id;

    #[ORM\Column(name: 'name', type: 'string', nullable: false)]
    private string $name;

    #[ORM\Column(name: 'amount', type: 'integer', nullable: false)]
    private int $amount;

    #[ORM\Column(name: 'stock_id', type: 'guid', nullable: false)]
    private string $stockId;

    #[ORM\Column(name: 'stock_name', type: 'string', nullable: false)]
    private string $stockName;

    public function __construct(
        ProductId $id,
        ProductName $name,
        Amount $amount,
        StockId $stockId,
        StockName $stockName,
    )
    {
        $this->id = $id->uuid;
        $this->name = $name->name;
        $this->amount = $amount->amount;
        $this->stockId = $stockId->uuid;
        $this->stockName = $stockName->name;
    }

    public function getId(): ProductId
    {
        return new ProductId($this->id);
    }

    public function getName(): ProductName
    {
        return new ProductName($this->name);
    }

    public function getStockName(): StockName
    {
        return new StockName($this->stockName);
    }

    public function getAmount(): Amount
    {
        return new Amount($this->amount);
    }
}
