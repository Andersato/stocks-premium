<?php

namespace App\Repository\Filters\Statistics;

interface StatisticFilterInterface
{
    public function createFilter(): array;
}