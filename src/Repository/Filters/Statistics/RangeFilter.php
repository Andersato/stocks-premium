<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

use App\Model\InformationStock\ParamsElasticSearch;

abstract class RangeFilter implements StatisticFilterInterface
{
    public ?float $minValue = null;
    public ?float $maxValue = null;

    public abstract function getField(): string;

    public function getMinValue(): ?float
    {
        return $this->minValue;
    }

    public function getMaxValue(): ?float
    {
        return $this->maxValue;
    }

    public function createFilter(): array
    {
        if (null === $this->getMinValue() && null === $this->getMaxValue()) {
            return [];
        }

        $ranges = [];
        if ($this->getMinValue()) {
            $ranges[ParamsElasticSearch::GTE] = $this->getMinValue();
        }
        if ($this->getMaxValue()) {
            $ranges[ParamsElasticSearch::LTE] = $this->getMaxValue();
        }

        return [
            ParamsElasticSearch::RANGE => [
                $this->getField() => $ranges
            ]
        ];
    }
}