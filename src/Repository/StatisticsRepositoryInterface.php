<?php

namespace App\Repository;

use App\Repository\Filters\Statistics\StatisticFilter;

interface StatisticsRepositoryInterface
{
    public function searchByFilters(StatisticFilter $filters): array;
    public function findAggregationsToFilters(StatisticFilter $filters): array;
}