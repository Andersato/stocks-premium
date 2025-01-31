<?php

declare(strict_types=1);


namespace App\Response\InformationStock\About;

use App\Response\AppResponseInterface;
use App\Response\ObjectResponseInterface;

final class GetStockProfileResponse implements AppResponseInterface, ObjectResponseInterface
{
    private ?string $ticker = null;

    private ?string $name = null;

    private ?string $sector = null;

    private ?string $industry = null;

    private ?string $indexName = null;

    private ?string $marketCap = null;

    private ?float $employees = null;
    private ?float $beta = null;
    private ?float $price = null;

    public static function create(
        ?string $ticker,
        ?string $name,
        ?string $sector,
        ?string $industry,
        ?string $indexName,
        ?string $marketCap,
        ?float $employees,
        ?float $beta,
        ?float $price
    ): self
    {
        $infoStock = new self();
        $infoStock->ticker = $ticker;
        $infoStock->name = $name;
        $infoStock->sector = $sector;
        $infoStock->industry = $industry;
        $infoStock->indexName = $indexName;
        $infoStock->marketCap = $marketCap;
        $infoStock->employees = $employees;
        $infoStock->beta = $beta;
        $infoStock->price = $price;

        return $infoStock;
    }


    public function getTicker(): ?string
    {
        return $this->ticker;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function getIndustry(): ?string
    {
        return $this->industry;
    }

    public function getIndexName(): ?string
    {
        return $this->indexName;
    }

    public function getMarketCap(): ?string
    {
        return $this->marketCap;
    }

    public function getEmployees(): ?float
    {
        return $this->employees;
    }

    public function getBeta(): ?float
    {
        return $this->beta;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
}