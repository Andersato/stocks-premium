<?php

declare(strict_types=1);


namespace App\Response\InformationStock\List\Performance;

use App\Response\AppResponseInterface;

final class GetPerformanceInformationStockResponse implements AppResponseInterface
{
    private string $ticker;
    private string $name;
    private string $sector;
    private string $industry;
    private float $marketCap;
    private float $price;
    private float $priceClose;
    private float $change;

    public static function create(string $ticker, string $name, string $sector, string $industry, float $marketCap, float $price, float $priceClose, float $change): self
    {
        $response = new self();

        $response->ticker = $ticker;
        $response->name = $name;
        $response->sector = $sector;
        $response->industry = $industry;
        $response->marketCap = $marketCap;
        $response->price = $price;
        $response->priceClose = $priceClose;
        $response->change = $change;

        return $response;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSector(): string
    {
        return $this->sector;
    }

    public function getIndustry(): string
    {
        return $this->industry;
    }

    public function getMarketCap(): float
    {
        return $this->marketCap;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPriceClose(): float
    {
        return $this->priceClose;
    }

    public function getChange(): float
    {
        return $this->change;
    }
}