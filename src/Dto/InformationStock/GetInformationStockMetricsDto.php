<?php

declare(strict_types=1);


namespace App\Dto\InformationStock;

final class GetInformationStockMetricsDto
{
    private string $ticker;

    public function __construct(
        public readonly array $metrics = []
    )
    {
    }

    public function setTicker(string $ticker): void
    {
        $this->ticker = $ticker;
    }

    public function getTicker(): ?string
    {
        return $this->ticker;
    }

    public function getMetrics(): array
    {
        return $this->metrics;
    }
}