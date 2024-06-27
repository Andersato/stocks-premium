<?php

declare(strict_types=1);


namespace App\Service\Statistic;

use App\Repository\Filters\Statistics\StatisticFilter;
use App\Repository\StatisticsRepositoryInterface;

final class GenerateAggregationsToFiltersService
{
    private StatisticsRepositoryInterface $statisticsRepository;

    public function __construct(StatisticsRepositoryInterface $statisticsRepository)
    {
        $this->statisticsRepository = $statisticsRepository;
    }

    public function __invoke(StatisticFilter $filter): array
    {
        $this->statisticsRepository->findAggregationsToFilters($filter);
    }
}