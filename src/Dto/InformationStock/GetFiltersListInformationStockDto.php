<?php

declare(strict_types=1);


namespace App\Dto\InformationStock;

final class GetFiltersListInformationStockDto
{
    private ?string $sector;
    private ?string $marketCap;
    private ?string $per;
    private ?string $high52W;

    public static function create (
        ?string $sector = null,
        ?string $marketCap = null,
        ?string $per = null,
        ?string $high52W = null
    ): self
    {
        $filters = new self();
        $filters->sector = $sector;
        $filters->marketCap = $marketCap;
        $filters->per = $per;
        $filters->high52W = $high52W;

        return $filters;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function getMarketCap(): ?string
    {
        return $this->marketCap;
    }

    public function getPer(): ?string
    {
        return $this->per;
    }

    public function getHigh52W(): ?string
    {
        return $this->high52W;
    }

}