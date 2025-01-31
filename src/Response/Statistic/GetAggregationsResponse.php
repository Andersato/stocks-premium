<?php

declare(strict_types=1);


namespace App\Response\Statistic;

use App\Model\InformationStock\ParamsElasticSearch;
use App\Response\AppResponseInterface;
use App\Response\Shared\KeyCountPairResponse;

final class GetAggregationsResponse implements AppResponseInterface
{
    private array $aggregations;

    public function __construct(array $aggregations)
    {
        $this->aggregations = $aggregations;
    }

    public function getAggregations(): array
    {
        return $this->aggregations;
    }
}