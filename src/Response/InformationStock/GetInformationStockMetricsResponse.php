<?php

declare(strict_types=1);


namespace App\Response\InformationStock;

use App\Response\AppResponseInterface;

final class GetInformationStockMetricsResponse implements AppResponseInterface
{
    private string $day;
    private float $metric;
    public static function create(string $day, float $metric): self
    {
        $response = new self();
        $response->day = $day;
        $response->metric = $metric;

        return $response;
    }

    public function getDay(): string
    {
        return $this->day;
    }

    public function getMetric(): float
    {
        return $this->metric;
    }
}