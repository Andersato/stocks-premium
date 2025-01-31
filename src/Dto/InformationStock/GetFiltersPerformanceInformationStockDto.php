<?php

declare(strict_types=1);


namespace App\Dto\InformationStock;

final class GetFiltersPerformanceInformationStockDto
{
    private ?string $performanceCategory;
    private ?string $marketCap;
    private ?string $sector;

    public static function create (
        ?string $performanceCategory = null,
        ?string $sector = null,
        ?string $marketCap = null,
    ): self
    {
        $filters = new self();
        $filters->performanceCategory = $performanceCategory;
        $filters->sector = $sector;
        $filters->marketCap = $marketCap;

        return $filters;
    }

    public function getPerformanceCategory(): ?string
    {
        return $this->performanceCategory;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function getMarketCap(): ?string
    {
        return $this->marketCap;
    }
}