<?php

namespace App\Read\Product\Shared\Infrastructure\ReadModel;

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
        string $id,
        string $name,
        int $amount,
        string $stockId,
        string $stockName,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->amount = $amount;
        $this->stockId = $stockId;
        $this->stockName = $stockName;
    }
}
