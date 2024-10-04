<?php

declare(strict_types=1);


namespace App\Response\Statistic;

final class InfoIndustryStatisticResponse
{
    private string $name;

    /** @var InfoStockStatisticResponse[]  */
    private array $stocks;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStocks(): array
    {
        return $this->stocks;
    }

    public function setStocks(array $stocks): void
    {
        $this->stocks = $stocks;
    }

    public function addStock(InfoStockStatisticResponse $infoStockStatisticResponse): void
    {
        $this->stocks[] = $infoStockStatisticResponse;
    }

}