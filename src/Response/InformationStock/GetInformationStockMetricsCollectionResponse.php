<?php

declare(strict_types=1);


namespace App\Response\InformationStock;

use App\Response\AppResponseInterface;

final class GetInformationStockMetricsCollectionResponse implements AppResponseInterface
{
    /** @var GetInformationStockMetricsResponse[] $metrics  */
    private array $metrics;

    public static function create(): self
    {
        return new self();
    }

    public function __construct()
    {
        $this->metrics = [];
    }

    public function addMetric(GetInformationStockMetricsResponse $informationStockMetricsResponse): void
    {
        $this->metrics[] = $informationStockMetricsResponse;
    }

    public function getMetrics(): array
    {
        return $this->metrics;
    }
}