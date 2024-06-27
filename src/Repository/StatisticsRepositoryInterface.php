<?php

namespace App\Repository;

use App\Repository\Filters\Statistics\StatisticFilter;

interface StatisticsRepositoryInterface
{
    public function searchByFilters(StatisticFilter $filters): void;
    public function findAggregationsToFilters(StatisticFilter $filters);
}