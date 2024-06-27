<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class PerfQuarterFilter extends RangeFilter
{
    final public const FIELD = 'perfQuarter';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}