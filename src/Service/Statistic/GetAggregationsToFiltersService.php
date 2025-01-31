<?php

declare(strict_types=1);


namespace App\Service\Statistic;

use App\Repository\Filters\Statistics\StatisticFilter;
use App\Repository\StatisticsRepositoryInterface;
use App\Response\Statistic\GetAggregationsResponse;
use App\Response\Statistic\GetAggregationTransform;

final class GetAggregationsToFiltersService
{
    private StatisticsRepositoryInterface $statisticsRepository;

    public function __construct(StatisticsRepositoryInterface $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    public function __invoke(StatisticFilter $filter, array $aggregations): GetAggregationsResponse
    {
        $aggregations = $this->statisticsRepository->findAggregations($filter, $aggregations);

        return GetAggregationTransform::transform($aggregations);
    }
}