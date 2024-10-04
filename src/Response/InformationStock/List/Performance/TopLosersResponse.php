<?php

declare(strict_types=1);


namespace App\Response\InformationStock\List\Performance;

final class TopLosersResponse
{
    private array $smallCaps = [];
    private array $midCaps = [];
    private array $largeCaps = [];
    private array $megaCaps = [];

    public function addSmallCaps(GetPerformanceInformationStockResponse $performanceInformationStockResponse, string $industry): void
    {
        $this->smallCaps[$industry][] = $performanceInformationStockResponse;
    }

    public function addMidCaps(GetPerformanceInformationStockResponse $performanceInformationStockResponse, string $industry): void
    {
        $this->midCaps[$industry][] = $performanceInformationStockResponse;
    }

    public function addLargeCaps(GetPerformanceInformationStockResponse $performanceInformationStockResponse, string $industry): void
    {
        $this->largeCaps[$industry][] = $performanceInformationStockResponse;
    }

    public function addMegaCaps(GetPerformanceInformationStockResponse $performanceInformationStockResponse, string $industry): void
    {
        $this->megaCaps[$industry][] = $performanceInformationStockResponse;
    }

    public function getSmallCaps(): array
    {
        return $this->smallCaps;
    }

    public function getMidCaps(): array
    {
        return $this->midCaps;
    }

    public function getLargeCaps(): array
    {
        return $this->largeCaps;
    }

    public function getMegaCaps(): array
    {
        return $this->megaCaps;
    }
}