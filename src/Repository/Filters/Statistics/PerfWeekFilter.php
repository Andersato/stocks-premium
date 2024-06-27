<?php

declare(strict_types=1);


namespace App\Repository\Filters\Statistics;

final class PerfWeekFilter extends RangeFilter
{
    final public const FIELD = 'perfWeek';
    
    public function getField(): string
    {
        return self::FIELD;
    }
}