<?php

declare(strict_types=1);


namespace App\Response\InformationStock\List;

use App\Response\AppResponseInterface;

final class GetListInformationStockResponse implements AppResponseInterface
{
    private string $ticker;
    private string $name;
    private string $sector;
    private string $industry;
    private float $marketCap;
    private float $price;
    private float $distance52W;
    private float $high52W;
    private float $low52W;

    public static function create(
        string $ticker, string $name, string $sector, string $industry,
        float $marketCap, float $price, string $range52W, float $distance52W
    ): self
    {
        $response = new self();

        $response->ticker = $ticker;
        $response->name = $name;
        $response->sector = $sector;
        $response->industry = $industry;
        $response->marketCap = $marketCap;
        $response->price = $price;
        $response->distance52W = $distance52W;

        if (preg_match('/^\s*([0-9.]+)\s*-\s*([0-9.]+)\s*$/', $range52W, $matches)) {
            $response->low52W = (float) $matches[1];
            $response->high52W = (float) $matches[2];
        }

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

    public function getHigh52W(): float
    {
        return $this->high52W;
    }

    public function getLow52W(): float
    {
        return $this->low52W;
    }

    public function getDistance52W(): float
    {
        return $this->distance52W;
    }
}